<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $projects = $query->with(['client', 'provider'])
            ->latest()
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => ProjectResource::collection($projects),
            'pagination' => [
                'total' => $projects->total(),
                'per_page' => $projects->perPage(),
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
            ],
        ]);
    }

    public function show(string $id)
    {
        $project = Project::with(['client', 'provider'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => new ProjectResource($project),
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if (!$user->isClient()) {
            return response()->json([
                'success' => false,
                'message' => 'Only clients can create projects',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:1000',
            'category' => 'required|string',
            'deadline' => 'nullable|date|after:today',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'client_id' => $user->id,
            'budget' => $request->budget,
            'category' => $request->category,
            'deadline' => $request->deadline,
            'status' => 'pending',
        ]);

        if ($request->hasFile('attachments')) {
            $attachments = [];
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('projects/' . $project->id, 'public');
                $attachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime' => $file->getMimeType(),
                ];
            }
            $project->attachments = $attachments;
            $project->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Project created successfully',
            'data' => new ProjectResource($project),
        ], 201);
    }

    public function apply(Request $request, string $id)
    {
        $user = $request->user();

        if (!$user->isProvider()) {
            return response()->json([
                'success' => false,
                'message' => 'Only providers can apply for projects',
            ], 403);
        }

        $project = Project::findOrFail($id);

        if ($project->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'This project is no longer accepting applications',
            ], 400);
        }

        if ($project->provider_id) {
            return response()->json([
                'success' => false,
                'message' => 'This project already has a provider',
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'proposal' => 'required|string',
            'bid_amount' => 'required|numeric|min:1|max:' . $project->budget,
            'estimated_days' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $project->provider_id = $user->id;
        $project->status = 'proposals';
        $project->save();

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully',
        ]);
    }

    public function markComplete(Request $request, string $id)
    {
        $user = $request->user();
        $project = Project::findOrFail($id);

        if ((int) $project->provider_id !== (int) $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Only the assigned provider can mark project as complete',
            ], 403);
        }

        if ($project->status !== 'in_progress') {
            return response()->json([
                'success' => false,
                'message' => 'Project must be in progress to mark as complete',
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'completion_notes' => 'nullable|string',
            'deliverables' => 'required|array',
            'deliverables.*' => 'file|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        if ($request->hasFile('deliverables')) {
            $deliverables = [];
            foreach ($request->file('deliverables') as $file) {
                $path = $file->store('projects/' . $project->id . '/deliverables', 'public');
                $deliverables[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime' => $file->getMimeType(),
                ];
            }

            $existing = is_array($project->attachments) ? $project->attachments : [];
            $project->attachments = array_values(array_merge($existing, [
                ['deliverables' => $deliverables],
            ]));
        }

        $project->status = 'review';
        $project->provider_notes = $request->completion_notes;
        $project->save();

        return response()->json([
            'success' => true,
            'message' => 'Project marked as complete, waiting for client review',
        ]);
    }

    public function approve(Request $request, string $id)
    {
        $user = $request->user();
        $project = Project::findOrFail($id);

        if ((int) $project->client_id !== (int) $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Only the client can approve the project',
            ], 403);
        }

        if ($project->status !== 'review') {
            return response()->json([
                'success' => false,
                'message' => 'Project must be in review to approve',
            ], 400);
        }

        $project->status = 'completed';
        $project->completed_at = now();
        $project->save();

        return response()->json([
            'success' => true,
            'message' => 'Project approved. Payment will be released to provider.',
        ]);
    }
}
