<header class="topbar">
    <div class="topbar-left">
        <button type="button" class="topbar-icon-btn" onclick="toggleSidebar()" aria-label="Toggle sidebar">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2 12C2 8.31087 2 6.4663 2.81382 5.15877C3.1149 4.67502 3.48891 4.25427 3.91891 3.91554C5.08116 3 6.72077 3 10 3H14C17.2792 3 18.9188 3 20.0811 3.91554C20.5111 4.25427 20.8851 4.67502 21.1862 5.15877C22 6.4663 22 8.31087 22 12C22 15.6891 22 17.5337 21.1862 18.8412C20.8851 19.325 20.5111 19.7457 20.0811 20.0845C18.9188 21 17.2792 21 14 21H10C6.72077 21 5.08116 21 3.91891 20.0845C3.48891 19.7457 3.1149 19.325 2.81382 18.8412C2 17.5337 2 15.6891 2 12Z" />
                <path stroke-linejoin="round" d="M9.5 3L9.5 21" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 7H6M5 10H6" />
            </svg>
        </button>

        <nav class="breadcrumb" aria-label="breadcrumb">
            @yield('breadcrumb')
        </nav>
    </div>

    <div class="topbar-right">
        <button type="button" class="topbar-icon-btn" aria-label="Notifications">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 18V9.5C19 5.63401 15.866 2.5 12 2.5C8.13401 2.5 5 5.63401 5 9.5V18" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.5 18H3.5" />
                <path stroke-linejoin="round" d="M13.5 20C13.5 20.8284 12.8284 21.5 12 21.5M10.5 20C10.5 20.8284 11.1716 21.5 12 21.5M12 21.5V20" />
            </svg>
        </button>

        <div class="user-dropdown" id="userDropdown">
            <button type="button" class="user-avatar-btn" onclick="toggleUserDropdown()" aria-label="Open user menu">
                <div class="user-avatar" style="{{ ((method_exists($user, 'hasProfilePhotoColumn') && $user->hasProfilePhotoColumn() && $user->profile_photo_path) || (method_exists($user, 'hasGravatarColumn') && $user->hasGravatarColumn() && $user->use_gravatar)) ? 'background: none; padding: 0;' : '' }}">
                    @if((method_exists($user, 'hasProfilePhotoColumn') && $user->hasProfilePhotoColumn() && $user->profile_photo_path) || (method_exists($user, 'hasGravatarColumn') && $user->hasGravatarColumn() && $user->use_gravatar && $user->email))
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    @else
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    @endif
                </div>
            </button>

            <div class="user-dropdown-menu">
                <div class="dropdown-header" style="padding: 0.75rem 1rem; border-bottom: 1px solid #f3f4f6;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div class="user-avatar" style="width: 36px; height: 36px; {{ ((method_exists($user, 'hasProfilePhotoColumn') && $user->hasProfilePhotoColumn() && $user->profile_photo_path) || (method_exists($user, 'hasGravatarColumn') && $user->hasGravatarColumn() && $user->use_gravatar)) ? 'background: none; padding: 0;' : '' }}">
                            @if((method_exists($user, 'hasProfilePhotoColumn') && $user->hasProfilePhotoColumn() && $user->profile_photo_path) || (method_exists($user, 'hasGravatarColumn') && $user->hasGravatarColumn() && $user->use_gravatar && $user->email))
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            @else
                                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                            @endif
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <span style="font-size: 0.875rem; font-weight: 600; color: #111827;">{{ $user->name }}</span>
                            <span style="font-size: 0.75rem; color: #6b7280;">{{ $user->email }}</span>
                        </div>
                    </div>
                </div>

                <div style="padding: 0.25rem;">
                    @php
                        $authUser = auth()->user();
                        $isAdminUser = false;
                        if ($authUser) {
                            $adminRoles = config('tyro-dashboard.admin_roles', ['admin', 'super-admin']);
                            if (method_exists($authUser, 'tyroRoleSlugs')) {
                                $userRoles = $authUser->tyroRoleSlugs();
                                foreach ($adminRoles as $role) {
                                    if (in_array($role, $userRoles)) {
                                        $isAdminUser = true;
                                        break;
                                    }
                                }
                            }

                            if (!$isAdminUser && method_exists($authUser, 'isAdmin')) {
                                $isAdminUser = (bool) $authUser->isAdmin();
                            }
                        }
                        $viewMode = session('tyro_dashboard_view_mode');
                    @endphp

                    @if($isAdminUser)
                        @if($viewMode === 'user')
                            <form action="{{ route('tyro-dashboard.mode.admin') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item" style="width: 100%; border: none; background: none; display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem 0.75rem; border-radius: 0.375rem; color: #374151; font-size: 0.875rem; transition: background 0.2s; cursor: pointer;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 8l-4 4 4 4" />
                                    </svg>
                                    Back to admin
                                </button>
                            </form>
                        @else
                            <form action="{{ route('tyro-dashboard.mode.user') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item" style="width: 100%; border: none; background: none; display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem 0.75rem; border-radius: 0.375rem; color: #374151; font-size: 0.875rem; transition: background 0.2s; cursor: pointer;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M22 21v-2a4 4 0 00-3-3.87" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 3.13a4 4 0 010 7.75" />
                                    </svg>
                                    View as user
                                </button>
                            </form>
                        @endif
                    @endif

                    <a href="{{ route('tyro-dashboard.profile') }}" class="dropdown-item" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem 0.75rem; border-radius: 0.375rem; color: #374151; font-size: 0.875rem; transition: background 0.2s;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile
                    </a>
                    
                    <a href="#" class="dropdown-item" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem 0.75rem; border-radius: 0.375rem; color: #374151; font-size: 0.875rem; transition: background 0.2s;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M5.636 18.364l3.536-3.536m5.656 0l3.536 3.536M5.636 5.636l3.536 3.536m0 5.656l-3.536 3.536" />
                            <circle cx="12" cy="12" r="8" />
                        </svg>
                        Support
                    </a>
                </div>

                <div style="padding: 0.25rem; border-top: 1px solid #f3f4f6;">
                    <button type="button" class="dropdown-item" onclick="toggleDarkMode()" style="width: 100%; border: none; background: none; display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem 0.75rem; border-radius: 0.375rem; color: #374151; font-size: 0.875rem; transition: background 0.2s; cursor: pointer;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        Dark Mode
                    </button>

                    @if(session('impersonator_id'))
                        <form action="{{ route('tyro-dashboard.leave-impersonation') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="width: 100%; border: none; background: none; display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem 0.75rem; border-radius: 0.375rem; color: #374151; font-size: 0.875rem; transition: background 0.2s; cursor: pointer;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Exit Impersonation
                            </button>
                        </form>
                    @else
                        <form action="{{ route('tyro-login.logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="width: 100%; border: none; background: none; display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem 0.75rem; border-radius: 0.375rem; color: #374151; font-size: 0.875rem; transition: background 0.2s; cursor: pointer;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Log out
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
