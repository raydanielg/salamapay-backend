<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Escrow;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Admin mode check
        $isAdmin = session('tyro_dashboard_view_mode') !== 'user' && ($user->hasRole('admin') || $user->hasRole('super-admin'));

        if ($isAdmin) {
            return $this->adminDashboard($user);
        }

        return $this->userDashboard($user);
    }

    protected function adminDashboard($user)
    {
        $stats = [
            'total_users' => User::count(),
            'total_escrows' => Escrow::count(),
            'total_transactions' => Transaction::count(),
            'escrow_volume' => Escrow::whereIn('status', ['funded', 'released'])->sum('amount'),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_transactions' => Transaction::with(['fromUser', 'toUser'])->latest()->take(10)->get(),
            'suspended_users' => User::where('account_status', 'suspended')->count(),
            'role_distribution' => \DB::table(config('tyro.tables.pivot', 'user_roles'))
                ->join(config('tyro.tables.roles', 'roles'), 'role_id', '=', config('tyro.tables.roles', 'roles').'.id')
                ->select(config('tyro.tables.roles', 'roles').'.name', \DB::raw('count(*) as count'))
                ->groupBy(config('tyro.tables.roles', 'roles').'.id', config('tyro.tables.roles', 'roles').'.name')
                ->get(),
        ];

        return view('tyro-dashboard::dashboard.index', [
            'user' => $user,
            'isAdmin' => true,
            'stats' => $stats
        ]);
    }

    protected function userDashboard($user)
    {
        // Ensure wallet exists
        $wallet = $user->wallet ?: $user->wallet()->create([
            'id' => \Illuminate\Support\Str::uuid(),
            'currency' => 'TZS',
            'available_balance' => 0,
            'pending_balance' => 0,
            'locked_balance' => 0,
        ]);

        $stats = [
            'wallet' => $wallet,
            'recent_transactions' => Transaction::where('from_user_id', $user->id)
                ->orWhere('to_user_id', $user->id)
                ->latest()
                ->take(5)
                ->get(),
            'active_escrows_count' => Escrow::where(function($q) use ($user) {
                $q->where('buyer_id', $user->id)->orWhere('seller_id', $user->id);
            })->whereIn('status', ['created', 'funded', 'disputed'])->count(),
        ];
        
        return view('tyro-dashboard::dashboard.index', [
            'user' => $user,
            'isAdmin' => false,
            'stats' => $stats
        ]);
    }
}
