<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $attachments = $this->attachments;
        if (is_array($attachments)) {
            $attachments = array_map(function ($attachment) {
                if (!is_array($attachment)) {
                    return $attachment;
                }

                if (isset($attachment['path']) && is_string($attachment['path']) && $attachment['path'] !== '') {
                    $attachment['url'] = Storage::disk('public')->url($attachment['path']);
                }

                if (isset($attachment['deliverables']) && is_array($attachment['deliverables'])) {
                    $attachment['deliverables'] = array_map(function ($deliverable) {
                        if (!is_array($deliverable)) {
                            return $deliverable;
                        }

                        if (isset($deliverable['path']) && is_string($deliverable['path']) && $deliverable['path'] !== '') {
                            $deliverable['url'] = Storage::disk('public')->url($deliverable['path']);
                        }

                        return $deliverable;
                    }, $attachment['deliverables']);
                }

                return $attachment;
            }, $attachments);
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'budget' => $this->budget,
            'escrow_amount' => $this->escrow_amount,
            'status' => $this->status,
            'category' => $this->category,
            'deadline' => $this->deadline,
            'client' => new UserResource($this->whenLoaded('client')),
            'provider' => new UserResource($this->whenLoaded('provider')),
            'attachments' => $attachments,
            'milestones' => $this->milestones,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
