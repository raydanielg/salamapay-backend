@extends('tyro-dashboard::layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
<span>Dashboard</span>
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-row">
        <div>
            <h1 class="page-title">Welcome back, {{ $user->full_name ?? 'User' }}!</h1>
            <p class="page-description">Hapa kuna muhtasari wa akaunti yako leo.</p>
        </div>
    </div>
</div>

@if($isAdmin ?? false)
<!-- Admin Dashboard -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon stat-icon-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
        </div>
        <div class="stat-content">
            <div class="stat-label">Total Users</div>
            <div class="stat-value">{{ number_format($stats['total_users'] ?? 0) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
        </div>
        <div class="stat-content">
            <div class="stat-label">Total Escrows</div>
            <div class="stat-value">{{ number_format($stats['total_escrows'] ?? 0) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-info">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
        <div class="stat-content">
            <div class="stat-label">Escrow Volume</div>
            <div class="stat-value">{{ number_format($stats['escrow_volume'] ?? 0, 2) }} TZS</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-danger">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
        </div>
        <div class="stat-content">
            <div class="stat-label">Suspended Users</div>
            <div class="stat-value">{{ number_format($stats['suspended_users'] ?? 0) }}</div>
        </div>
    </div>
</div>

@php
    $adminMenus = [
        [
            'title' => 'Transactions',
            'description' => 'Dhibiti miamala yote ya mfumo kwa usalama.',
            'route' => 'tyro-dashboard.transactions',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>',
            'color' => 'indigo'
        ],
        [
            'title' => 'Users Management',
            'description' => 'Dhibiti watumiaji, kyc zao na hali za akaunti.',
            'route' => 'tyro-dashboard.users.index',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>',
            'color' => 'blue'
        ],
        [
            'title' => 'Roles & Privileges',
            'description' => 'Dhibiti majukumu ya wafanyakazi na ruhusa zao.',
            'route' => 'tyro-dashboard.roles.index',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>',
            'color' => 'purple'
        ],
        [
            'title' => 'Resources',
            'description' => 'Dhibiti dynamic resources na maudhui ya mfumo.',
            'route' => 'tyro-dashboard.resources.index',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>',
            'color' => 'green'
        ],
        [
            'title' => 'Audit Logs',
            'description' => 'Fuatilia kila mabadiliko yanayofanyika kwenye mfumo.',
            'route' => 'tyro-dashboard.audits.index',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
            'color' => 'orange'
        ],
        [
            'title' => 'System Settings',
            'description' => 'Dhibiti mipangilio mikuu ya SalamaPay.',
            'route' => 'tyro-dashboard.admin.settings.index',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>',
            'color' => 'gray'
        ]
    ];
@endphp

<div id="admin-menus" class="mt-10">
    <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
        <span class="w-2 h-8 bg-indigo-600 rounded-full"></span>
        Master Control Center
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($adminMenus as $menu)
            @if(\Illuminate\Support\Facades\Route::has($menu['route']))
            <a href="{{ route($menu['route']) }}" class="group bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:border-indigo-100 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-{{ $menu['color'] }}-50 text-{{ $menu['color'] }}-600 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        {!! $menu['icon'] !!}
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $menu['title'] }}</h3>
                        <p class="text-sm text-slate-500 line-clamp-1">{{ $menu['description'] }}</p>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <svg class="w-5 h-5 text-slate-300 group-hover:text-indigo-500 group-hover:translate-x-1 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7" /></svg>
                </div>
            </a>
            @endif
        @endforeach
    </div>
</div>

<div class="grid-2 mt-10">
    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recent Transactions</h3>
            <a href="{{ route('tyro-dashboard.transactions') }}" class="btn btn-sm btn-ghost">View All</a>
        </div>
        <div class="card-body" style="padding: 0;">
            @if(isset($stats['recent_transactions']) && $stats['recent_transactions']->count())
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['recent_transactions'] as $tx)
                        <tr>
                            <td><span class="font-mono text-xs">{{ $tx->reference_number }}</span></td>
                            <td><span class="badge badge-primary">{{ ucfirst(str_replace('_', ' ', $tx->type)) }}</span></td>
                            <td>{{ number_format($tx->amount, 2) }} {{ $tx->currency }}</td>
                            <td>
                                @php
                                    $statusClass = match($tx->status) {
                                        'completed' => 'badge-success',
                                        'pending' => 'badge-warning',
                                        'failed', 'reversed' => 'badge-danger',
                                        default => 'badge-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ ucfirst($tx->status) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <p class="empty-state-description">No recent transactions found.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Role Distribution -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Role Distribution</h3>
        </div>
        <div class="card-body">
            @if(isset($stats['role_distribution']) && $stats['role_distribution']->count())
                <div class="space-y-4">
                    @foreach($stats['role_distribution'] as $role)
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-slate-700">{{ $role->name }}</span>
                                <span class="text-sm font-bold text-slate-900">{{ $role->count }}</span>
                            </div>
                            <div class="w-100 bg-slate-100 rounded-full h-2">
                                @php
                                    $percentage = ($stats['total_users'] > 0) ? ($role->count / $stats['total_users']) * 100 : 0;
                                    $colors = ['bg-indigo-500', 'bg-blue-500', 'bg-green-500', 'bg-purple-500', 'bg-orange-500'];
                                    $color = $colors[$loop->index % count($colors)];
                                @endphp
                                <div class="{{ $color }} h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <p class="empty-state-description">No role data available.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="grid-1 mt-6">
    <!-- Recent Users -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recent Users</h3>
            @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.users.index'))
                <a href="{{ route('tyro-dashboard.users.index') }}" class="btn btn-sm btn-ghost">View All</a>
            @endif
        </div>
        <div class="card-body" style="padding: 0;">
            @if(isset($stats['recent_users']) && $stats['recent_users']->count())
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['recent_users'] as $u)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs">
                                        {{ substr($u->full_name, 0, 1) }}
                                    </div>
                                    <span class="font-medium">{{ $u->full_name }}</span>
                                </div>
                            </td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <span class="badge {{ $u->account_status === 'active' ? 'badge-success' : 'badge-danger' }}">
                                    {{ ucfirst($u->account_status) }}
                                </span>
                            </td>
                            <td class="text-slate-500 text-sm">{{ $u->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <p class="empty-state-description">No recent users found.</p>
            </div>
            @endif
        </div>
    </div>
</div>

@else
<!-- User Dashboard (Non-Admin) -->
<div class="sp-welcome">
    <div class="sp-welcome-left">
        <div class="sp-welcome-kicker">👋 Karibu tena!</div>
        <h2 class="sp-welcome-title">Habari, {{ $user->name ?? 'User' }}! ✨</h2>
        <p class="sp-welcome-desc">💚 Usalama kwanza. 📈 Fuatilia miamala yako, 🧾 pokea malipo, na 🚀 kukuza biashara yako ndani ya dashboard moja.</p>

        <div class="sp-welcome-actions">
            <a href="#" class="btn btn-primary">🚀 Anza Biashara</a>
            <a href="#" class="btn btn-secondary">💳 Angalia Malipo</a>
        </div>
    </div>

    <div class="sp-card" aria-label="Salamapay virtual card">
        <div class="sp-card-top">
            <div class="sp-card-brand">
                <div class="sp-card-logo" aria-hidden="true">
                    <svg viewBox="0 0 50 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.60.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z" fill="currentColor" />
                    </svg>
                </div>
                <div class="sp-card-brand-text">
                    <div class="sp-card-name">Salamapay</div>
                    <div class="sp-card-sub">Virtual Card</div>
                </div>
            </div>
            <div class="sp-card-visa">VISA</div>
        </div>

        <div class="sp-card-middle">
            <div class="sp-card-number">5282  ••••  ••••  2049</div>
            <div class="sp-card-row">
                <div class="sp-card-field">
                    <div class="sp-card-label">CARDHOLDER</div>
                    <div class="sp-card-value">{{ strtoupper($user->name ?? 'USER') }}</div>
                </div>
                <div class="sp-card-field">
                    <div class="sp-card-label">EXP</div>
                    <div class="sp-card-value">08/29</div>
                </div>
            </div>
        </div>

        <div class="sp-card-bottom">
            <div class="sp-card-chip" aria-hidden="true"></div>
            <div class="sp-card-qr" aria-hidden="true">
                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                    <rect width="64" height="64" fill="#fff" opacity="0.92" rx="8" />
                    <rect x="6" y="6" width="18" height="18" fill="#111827" rx="2" />
                    <rect x="10" y="10" width="10" height="10" fill="#fff" rx="1" />
                    <rect x="40" y="6" width="18" height="18" fill="#111827" rx="2" />
                    <rect x="44" y="10" width="10" height="10" fill="#fff" rx="1" />
                    <rect x="6" y="40" width="18" height="18" fill="#111827" rx="2" />
                    <rect x="10" y="44" width="10" height="10" fill="#fff" rx="1" />
                    <rect x="28" y="28" width="6" height="6" fill="#111827" />
                    <rect x="36" y="28" width="6" height="6" fill="#111827" />
                    <rect x="28" y="36" width="6" height="6" fill="#111827" />
                    <rect x="38" y="38" width="4" height="4" fill="#111827" />
                    <rect x="46" y="30" width="4" height="10" fill="#111827" />
                    <rect x="30" y="46" width="14" height="4" fill="#111827" />
                    <rect x="46" y="46" width="10" height="4" fill="#111827" />
                    <rect x="28" y="52" width="4" height="6" fill="#111827" />
                    <rect x="36" y="52" width="6" height="6" fill="#111827" />
                </svg>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
