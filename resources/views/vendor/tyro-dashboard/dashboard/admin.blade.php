@extends('tyro-dashboard::layouts.admin')

@section('title', 'Admin Dashboard')

@section('breadcrumb')
<span>Dashboard</span>
@endsection

@section('content')
<div class="admin-dashboard-page">
    <div class="dashboard-full-width">
        <div class="welcome-card">
            <div class="welcome-content">
                <div class="welcome-hello">Hello 👋✨</div>
                <h1 class="welcome-title">{{ $user->name ?? 'User' }}, welcome back</h1>
                <p class="welcome-desc">You're inside <b>Salamapay</b> Admin. Quickly review KPIs, manage users, and monitor system activity.</p>
                <div class="welcome-card-footer">
                    <div class="admin-welcome-actions">
                        <a href="#admin-menus" class="btn btn-primary">Browse All Menus</a>
                        @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.users.index'))
                            <a href="{{ route('tyro-dashboard.users.index') }}" class="btn btn-secondary">Manage Users</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Stats Grid -->
<div class="stats-grid admin-stats-grid">
    <div class="stat-card">
        <div class="stat-icon stat-icon-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <div class="stat-content">
            <div class="stat-label" style="font-size: 0.9375rem;">Total Users</div>
            <div class="stat-value">{{ number_format($stats['total_users'] ?? 0) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
        </div>
        <div class="stat-content">
            <div class="stat-label" style="font-size: 0.9375rem;">Total Roles</div>
            <div class="stat-value">{{ number_format($stats['total_roles'] ?? 0) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-info">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </svg>
        </div>
        <div class="stat-content">
            <div class="stat-label" style="font-size: 0.9375rem;">Total Privileges</div>
            <div class="stat-value">{{ number_format($stats['total_privileges'] ?? 0) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-danger">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
            </svg>
        </div>
        <div class="stat-content">
            <div class="stat-label" style="font-size: 0.9375rem;">Suspended Users</div>
            <div class="stat-value">{{ number_format($stats['suspended_users'] ?? 0) }}</div>
        </div>
    </div>

    @if(config('tyro-dashboard.features.invitation_system', true))
    <div class="stat-card">
        <div class="stat-icon stat-icon-info">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
            </svg>
        </div>
        <div class="stat-content">
            <div class="stat-label" style="font-size: 0.9375rem;">Invitation Links</div>
            <div class="stat-value">{{ number_format($stats['total_invitations'] ?? 0) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <div class="stat-content">
            <div class="stat-label" style="font-size: 0.9375rem;">Total Referrals</div>
            <div class="stat-value">{{ number_format($stats['total_referrals'] ?? 0) }}</div>
        </div>
    </div>
    @endif
</div>

<div class="admin-menu-explorer" id="admin-menus">
    <div class="admin-menu-explorer-header">
        <div>
            <div class="admin-menu-explorer-title">Browse All Menus</div>
            <div class="admin-menu-explorer-subtitle">Quick access to every dashboard page</div>
        </div>
    </div>

    <div class="admin-menu-grid">
        @php
            $menuCards = [
                [
                    'title' => 'Transactions',
                    'desc' => 'View all transactions',
                    'route' => 'tyro-dashboard.transactions',
                    'icon' => '<path d="M3 6.5C3 4.61438 3 3.67157 3.58579 3.08579C4.17157 2.5 5.11438 2.5 7 2.5H17C18.8856 2.5 19.8284 2.5 20.4142 3.08579C21 3.67157 21 4.61438 21 6.5V17.5C21 19.3856 21 20.3284 20.4142 20.9142C19.8284 21.5 18.8856 21.5 17 21.5H7C5.11438 21.5 4.17157 21.5 3.58579 20.9142C3 20.3284 3 19.3856 3 17.5V6.5Z"/><path d="M7 7H17"/><path d="M7 12H17"/><path d="M7 17H13"/>'
                ],
                [
                    'title' => 'Payments',
                    'desc' => 'Create a new payment',
                    'route' => 'tyro-dashboard.payments.create',
                    'icon' => '<path d="M2 12C2 8.46252 2 6.69377 3.0528 5.5129C3.22119 5.32403 3.40678 5.14935 3.60746 4.99087C4.86213 4 6.74142 4 10.5 4H13.5C17.2586 4 19.1379 4 20.3925 4.99087C20.5932 5.14935 20.7788 5.32403 20.9472 5.5129C22 6.69377 22 8.46252 22 12C22 15.5375 22 17.3062 20.9472 18.4871C20.7788 18.676 20.5932 18.8506 20.3925 19.0091C19.1379 20 17.2586 20 13.5 20H10.5C6.74142 20 4.86213 20 3.60746 19.0091C3.40678 18.8506 3.22119 18.676 3.0528 18.4871C2 17.3062 2 15.5375 2 12Z"/><path d="M10 16H11.5"/><path d="M14.5 16L18 16"/><path d="M2 9H22"/>'
                ],
                [
                    'title' => 'Withdrawals',
                    'desc' => 'Requested, pending & approved',
                    'route' => 'tyro-dashboard.withdrawals.requested',
                    'icon' => '<path d="M3.50002 10V15C3.50002 17.8284 3.50002 19.2426 4.37869 20.1213C5.25737 21 6.67159 21 9.50002 21H14.5C17.3284 21 18.7427 21 19.6213 20.1213C20.5 19.2426 20.5 17.8284 20.5 15V10"/><path d="M17 7.50184C17 8.88255 15.8807 9.99997 14.5 9.99997C13.1193 9.99997 12 8.88068 12 7.49997C12 8.88068 10.8807 9.99997 9.50002 9.99997C8.1193 9.99997 7.00002 8.88068 7.00002 7.49997C7.00002 8.88068 5.82655 9.99997 4.37901 9.99997C3.59984 9.99997 2.90008 9.67567 2.42 9.16087C1.59462 8.2758 2.12561 6.97403 2.81448 5.98842L3.20202 5.45851C4.08386 4.2527 4.52478 3.6498 5.16493 3.32494C5.80508 3.00008 6.55201 3.00018 8.04587 3.00038L15.9551 3.00143C17.4485 3.00163 18.1952 3.00173 18.8351 3.32658C19.475 3.65143 19.9158 4.25414 20.7974 5.45957L21.1855 5.99029C21.8744 6.97589 22.4054 8.27766 21.58 9.16273C21.0999 9.67754 20.4002 10.0018 19.621 10.0018C18.1734 10.0018 17 8.88255 17 7.50184Z"/><path d="M14.9971 17C14.3133 17.6072 13.2247 18 11.9985 18C10.7723 18 9.68376 17.6072 9 17"/>'
                ],
                [
                    'title' => 'Payouts',
                    'desc' => 'History & credentials',
                    'route' => 'tyro-dashboard.payouts.history',
                    'icon' => '<path d="M14.4998 14.001C14.4998 15.3817 13.3805 16.501 11.9998 16.501C10.619 16.501 9.49976 15.3817 9.49976 14.001C9.49976 12.6203 10.619 11.501 11.9998 11.501C13.3805 11.501 14.4998 12.6203 14.4998 14.001Z"/><path d="M8 7.88972C6.88069 7.88442 5.55979 7.75835 3.87798 7.42461C2.92079 7.23467 2 7.94632 2 8.92217V18.9392C2 19.6275 2.47265 20.232 3.1448 20.3802C10.1096 21.9161 11.2491 20.1104 16 20.1104C17.5107 20.1104 18.7361 20.253 19.6762 20.4305C20.7719 20.6375 22 19.7984 22 18.6833V8.90853C22 8.34037 21.6756 7.82599 21.1329 7.6578C20.3228 7.40675 18.9452 7.08767 17 7.00293"/><path d="M2 11.001C3.95133 11.001 5.70483 9.40605 5.92901 7.75514M18.5005 7.50098C18.5005 9.54062 20.2655 11.47 22 11.47M22 17.001C20.1009 17.001 18.2601 18.3112 18.102 20.0993M6.00049 20.4971C6.00049 18.2879 4.20963 16.4971 2.00049 16.4971"/><path d="M9.5 5.50098C9.5 5.50098 11.2998 3.00098 12 3.00098M14.5 5.50098C14.5 5.50098 12.7002 3.00098 12 3.00098M12 3.00098L12 8.50098"/>'
                ],
                [
                    'title' => 'Settings',
                    'desc' => 'Profile & 2FA',
                    'route' => 'tyro-dashboard.profile',
                    'icon' => '<path d="M21.3175 7.14139L20.8239 6.28479C20.4506 5.63696 20.264 5.31305 19.9464 5.18388C19.6288 5.05472 19.2696 5.15664 18.5513 5.36048L17.3311 5.70418C16.8725 5.80994 16.3913 5.74994 15.9726 5.53479L15.6357 5.34042C15.2766 5.11043 15.0004 4.77133 14.8475 4.37274L14.5136 3.37536C14.294 2.71534 14.1842 2.38533 13.9228 2.19657C13.6615 2.00781 13.3143 2.00781 12.6199 2.00781H11.5051C10.8108 2.00781 10.4636 2.00781 10.2022 2.19657C9.94085 2.38533 9.83106 2.71534 9.61149 3.37536L9.27753 4.37274C9.12465 4.77133 8.84845 5.11043 8.48937 5.34042L8.15249 5.53479C7.73374 5.74994 7.25259 5.80994 6.79398 5.70418L5.57375 5.36048C4.85541 5.15664 4.49625 5.05472 4.17867 5.18388C3.86109 5.31305 3.67445 5.63696 3.30115 6.28479L2.80757 7.14139C2.45766 7.74864 2.2827 8.05227 2.31666 8.37549C2.35061 8.69871 2.58483 8.95918 3.05326 9.48012L4.0843 10.6328C4.3363 10.9518 4.51521 11.5078 4.51521 12.0077C4.51521 12.5078 4.33636 13.0636 4.08433 13.3827L3.05326 14.5354C2.58483 15.0564 2.35062 15.3168 2.31666 15.6401C2.2827 15.9633 2.45766 16.2669 2.80757 16.8741L3.30114 17.7307C3.67443 18.3785 3.86109 18.7025 4.17867 18.8316C4.49625 18.9608 4.85542 18.8589 5.57377 18.655L6.79394 18.3113C7.25263 18.2055 7.73387 18.2656 8.15267 18.4808L8.4895 18.6752C8.84851 18.9052 9.12464 19.2442 9.2775 19.6428L9.61149 20.6403C9.83106 21.3003 9.94085 21.6303 10.2022 21.8191C10.4636 22.0078 10.8108 22.0078 11.5051 22.0078H12.6199C13.3143 22.0078 13.6615 22.0078 13.9228 21.8191C14.1842 21.6303 14.294 21.3003 14.5136 20.6403L14.8476 19.6428C15.0004 19.2442 15.2765 18.9052 15.6356 18.6752L15.9724 18.4808C16.3912 18.2656 16.8724 18.2055 17.3311 18.3113L18.5513 18.655C19.2696 18.8589 19.6288 18.9608 19.9464 18.8316C20.264 18.7025 20.4506 18.3785 20.8239 17.7307L21.3175 16.8741C21.6674 16.2669 21.8423 15.9633 21.8084 15.6401C21.7744 15.3168 21.5402 15.0564 21.0718 14.5354L20.0407 13.3827C19.7887 13.0636 19.6098 12.5078 19.6098 12.0077C19.6098 11.5078 19.7887 10.9518 20.0407 10.6328L21.0718 9.48012C21.5402 8.95918 21.7744 8.69871 21.8084 8.37549C21.8423 8.05227 21.6674 7.74864 21.3175 7.14139Z"/><path d="M15 12.0078C15 13.6647 13.6569 15.0078 12 15.0078C10.3431 15.0078 9 13.6647 9 12.0078C9 10.3509 10.3431 9.00781 12 9.00781C13.6569 9.00781 15 10.3509 15 12.0078Z"/>'
                ],
                [
                    'title' => 'Business',
                    'desc' => 'Business settings',
                    'route' => 'tyro-dashboard.business',
                    'icon' => '<path d="M3.5 10V15C3.5 17.8284 3.5 19.2426 4.37868 20.1213C5.25736 21 6.67157 21 9.5 21H14.5C17.3284 21 18.7426 21 19.6213 20.1213C20.5 19.2426 20.5 17.8284 20.5 15V10"/><path d="M17 7.50184C17 8.88255 15.8807 9.99997 14.5 9.99997C13.1193 9.99997 12 8.88068 12 7.49997C12 8.88068 10.8807 9.99997 9.5 9.99997C8.11929 9.99997 7 8.88068 7 7.49997C7 8.88068 5.82655 9.99997 4.37901 9.99997"/>'
                ],
                [
                    'title' => 'Support',
                    'desc' => 'Help & support center',
                    'route' => 'tyro-dashboard.support',
                    'icon' => '<circle cx="12" cy="12" r="10"/><path d="M9.5 9.5C9.5 8.11929 10.6193 7 12 7C13.3807 7 14.5 8.11929 14.5 9.5C14.5 10.3569 14.0689 11.1131 13.4117 11.5636C12.7283 12.0319 12 12.6716 12 13.5"/><path d="M12 17H12.009"/>'
                ],
                [
                    'title' => 'Developer',
                    'desc' => 'API keys, config & webhooks',
                    'route' => 'tyro-dashboard.developer.api-keys',
                    'icon' => '<path d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z"/><path d="M8.5 9.5L6 12L8.5 14.5"/><path d="M15.5 9.5L18 12L15.5 14.5"/><path d="M13 9L11 15"/>'
                ],
                [
                    'title' => 'Users',
                    'desc' => 'Manage users',
                    'route' => 'tyro-dashboard.users.index',
                    'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path d="M20 8v6"/><path d="M23 11h-6"/>'
                ],
                [
                    'title' => 'Roles',
                    'desc' => 'Manage roles',
                    'route' => 'tyro-dashboard.roles.index',
                    'icon' => '<path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"/>'
                ],
                [
                    'title' => 'Privileges',
                    'desc' => 'Manage privileges',
                    'route' => 'tyro-dashboard.privileges.index',
                    'icon' => '<path d="M12 2l8 4v6c0 5-3.5 9.5-8 10-4.5-.5-8-5-8-10V6l8-4Z"/><path d="M9 12l2 2 4-4"/>'
                ],
                [
                    'title' => 'Audit Logs',
                    'desc' => 'System activity logs',
                    'route' => 'tyro-dashboard.audits.index',
                    'icon' => '<path d="M9 12h6"/><path d="M9 16h4"/><path d="M6 20h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H8l-2 2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Z"/>'
                ],
            ];
        @endphp

        @foreach($menuCards as $card)
            @if(isset($card['route']) && \Illuminate\Support\Facades\Route::has($card['route']))
                <a href="{{ route($card['route']) }}" class="admin-menu-card">
                    <div class="admin-menu-card-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">{!! $card['icon'] !!}</svg>
                    </div>
                    <div class="admin-menu-card-content">
                        <div class="admin-menu-card-title">{{ $card['title'] }}</div>
                        <div class="admin-menu-card-desc">{{ $card['desc'] }}</div>
                    </div>
                </a>
            @endif
        @endforeach

        @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.developer.api-configuration'))
            <a href="{{ route('tyro-dashboard.developer.api-configuration') }}" class="admin-menu-card admin-menu-card-small">
                <div class="admin-menu-card-content">
                    <div class="admin-menu-card-title">API Configuration</div>
                    <div class="admin-menu-card-desc">Developer settings</div>
                </div>
            </a>
        @endif

        @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.developer.webhooks'))
            <a href="{{ route('tyro-dashboard.developer.webhooks') }}" class="admin-menu-card admin-menu-card-small">
                <div class="admin-menu-card-content">
                    <div class="admin-menu-card-title">Webhooks</div>
                    <div class="admin-menu-card-desc">Developer events</div>
                </div>
            </a>
        @endif

        @if(config('tyro-dashboard.features.invitation_system', true) && \Illuminate\Support\Facades\Route::has('tyro-dashboard.invitations.admin-index'))
            <a href="{{ route('tyro-dashboard.invitations.admin-index') }}" class="admin-menu-card admin-menu-card-small">
                <div class="admin-menu-card-content">
                    <div class="admin-menu-card-title">Invitations</div>
                    <div class="admin-menu-card-desc">Invite & referrals</div>
                </div>
            </a>
        @endif
    </div>
</div>

<div class="grid-2">
    <!-- Recent Users -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.0625rem;">Recent Users</h3>
            <a href="{{ route('tyro-dashboard.users.index') }}" class="btn btn-sm btn-ghost">View All</a>
        </div>
        <div class="card-body" style="padding: 0;">
            @if(isset($stats['recent_users']) && $stats['recent_users']->count())
            <div class="table-container">
                <table class="table">
                    <tbody>
                        @foreach($stats['recent_users'] as $recentUser)
                        <tr>
                            <td>
                                <a href="{{ route('tyro-dashboard.users.edit', $recentUser->id) }}" class="user-cell" style="text-decoration: none;">
                                    <div class="user-cell-avatar" style="{{ ($recentUser->profile_photo_path || $recentUser->use_gravatar) ? 'background: none; padding: 0;' : '' }}">
                                        @if($recentUser->profile_photo_path || ($recentUser->use_gravatar && $recentUser->email))
                                            <img src="{{ $recentUser->profile_photo_url }}" alt="{{ $recentUser->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                        @else
                                            {{ strtoupper(substr($recentUser->name, 0, 1)) }}
                                        @endif
                                    </div>
                                    <div class="user-cell-info">
                                        <div class="user-cell-name" style="font-size: 0.9375rem;">{{ $recentUser->name }}</div>
                                        <div class="user-cell-email" style="font-size: 0.8125rem;">{{ $recentUser->email }}</div>
                                    </div>
                                </a>
                            </td>
                            <td style="text-align: right;">
                                @if(method_exists($recentUser, 'isSuspended') && $recentUser->isSuspended())
                                    <span class="badge badge-danger">Suspended</span>
                                @else
                                    <span class="badge badge-success">Active</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <p class="empty-state-description" style="font-size: 0.9375rem;">No users found.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Role Distribution -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-size: 1.0625rem;">Role Distribution</h3>
            <a href="{{ route('tyro-dashboard.roles.index') }}" class="btn btn-sm btn-ghost">Manage Roles</a>
        </div>
        <div class="card-body" style="padding: 0;">
            @if(isset($stats['role_distribution']) && $stats['role_distribution']->count())
            <div class="table-container">
                <table class="table">
                    <tbody>
                        @foreach($stats['role_distribution'] as $roleStat)
                        <tr>
                            <td>
                                <a href="{{ route('tyro-dashboard.roles.show', $roleStat['id']) }}" style="text-decoration: none;">
                                    <span class="badge badge-primary" style="font-size: 0.875rem;">{{ $roleStat['name'] }}</span>
                                </a>
                            </td>
                            <td style="text-align: right;">
                                <strong style="font-size: 0.9375rem;">{{ $roleStat['count'] }}</strong> <span style="font-size: 0.9375rem;">users</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <p class="empty-state-description" style="font-size: 0.9375rem;">No roles found.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
function parseNumberLike(text) {
    if (!text) return 0;
    const cleaned = String(text).replace(/[^0-9.]/g, '');
    if (!cleaned) return 0;
    const n = parseFloat(cleaned);
    return Number.isFinite(n) ? n : 0;
}

function formatWithCommas(num) {
    try {
        return new Intl.NumberFormat().format(Math.round(num));
    } catch (e) {
        return String(Math.round(num));
    }
}

function animateCount(el, toValue) {
    const duration = 650;
    const start = performance.now();

    function tick(now) {
        const t = Math.min(1, (now - start) / duration);
        const eased = 1 - Math.pow(1 - t, 3);
        const current = toValue * eased;
        el.textContent = formatWithCommas(current);
        if (t < 1) requestAnimationFrame(tick);
    }

    requestAnimationFrame(tick);
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.admin-stats-grid .stat-value').forEach(function (el) {
        const target = parseNumberLike(el.textContent);
        if (!target) return;
        el.textContent = '0';
        animateCount(el, target);
    });
});
</script>
</div>
@endsection
