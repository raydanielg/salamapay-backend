@extends('tyro-dashboard::layouts.app')

@section('title', 'My Profile')

@section('breadcrumb')
<a href="{{ route('tyro-dashboard.index') }}">Dashboard</a>
<span class="breadcrumb-separator">/</span>
<span>My Profile</span>
@endsection

@section('content')
<div class="sp-profile">
    <div class="sp-profile-hero">
        <div class="sp-profile-hero-inner">
            <div>
                <h1 class="sp-profile-title">Profile</h1>
                <p class="sp-profile-subtitle">Manage your account information and verification status.</p>
            </div>
        </div>
    </div>

    <form action="{{ route('tyro-dashboard.profile.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
        @csrf
        @method('PUT')

        {{-- 1. Personal Information Card --}}
        <div class="card" style="padding: 0;">
            <div class="sp-field-group">
                {{-- Profile Photo Row --}}
                @if((config('tyro-dashboard.features.profile_photo_upload') && method_exists($user, 'hasProfilePhotoColumn') && $user->hasProfilePhotoColumn()) || (config('tyro-dashboard.features.gravatar') && method_exists($user, 'hasGravatarColumn') && $user->hasGravatarColumn()))
                <div class="sp-field-row">
                    <div class="sp-field-left">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><path d="M2 8.5C2 6.61438 2 5.67157 2.58579 5.08579C3.17157 4.5 4.11438 4.5 6 4.5H18C19.8856 4.5 20.8284 4.5 21.4142 5.08579C22 5.67157 22 6.61438 22 8.5V15.5C22 17.3856 22 18.3284 21.4142 18.9142C20.8284 19.5 19.8856 19.5 18 19.5H6C4.11438 19.5 3.17157 19.5 2.58579 18.9142C2 18.3284 2 17.3856 2 15.5V8.5Z" stroke="currentColor" stroke-width="1.5"/><path d="M7 15.5C7.8 14 9.4 13 12 13C14.6 13 16.2 14 17 15.5" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M15 9.5C15 11.1569 13.6569 12.5 12 12.5C10.3431 12.5 9 11.1569 9 9.5C9 7.84315 10.3431 6.5 12 6.5C13.6569 6.5 15 7.84315 15 9.5Z" stroke="currentColor" stroke-width="1.5"/></svg>
                        <div>
                            <div class="sp-field-title">Profile Photo</div>
                            <div class="sp-field-desc">Upload a profile image or use Gravatar.</div>
                        </div>
                    </div>
                    <div class="sp-field-right">
                        <div class="sp-photo-row">
                            @if((method_exists($user, 'hasProfilePhotoColumn') && $user->hasProfilePhotoColumn() && $user->profile_photo_path) || (method_exists($user, 'hasGravatarColumn') && $user->hasGravatarColumn() && $user->use_gravatar && $user->email))
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border);">
                            @else
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: var(--primary); color: var(--primary-foreground); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; font-weight: 600;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div style="flex: 1;">
                                <input type="file" name="photo" class="form-input text-xs" accept="image/*">
                            </div>
                        </div>
                        @if(method_exists($user, 'hasProfilePhotoColumn') && $user->hasProfilePhotoColumn() && $user->profile_photo_path)
                            <div style="margin-top: 0.5rem;">
                                <button type="button" class="text-danger text-xs font-medium" onclick="showDanger('Remove Photo', 'Are you sure?').then(confirmed => { if(confirmed) document.getElementById('delete-photo-form').submit(); })">Remove Photo</button>
                            </div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- First Name --}}
                <div class="sp-field-row">
                    <div class="sp-field-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><path d="M17 8.5C17 5.73858 14.7614 3.5 12 3.5C9.23858 3.5 7 5.73858 7 8.5C7 11.2614 9.23858 13.5 12 13.5C14.7614 13.5 17 11.2614 17 8.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M19 20.5C19 16.634 15.866 13.5 12 13.5C8.13401 13.5 5 16.634 5 20.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                        <div>
                            <div class="sp-field-title">First Name</div>
                            <div class="sp-field-desc">Your first name as registered.</div>
                        </div>
                    </div>
                    <div class="sp-field-right">
                        <input type="text" name="first_name" class="form-input" placeholder="First name" value="{{ old('first_name', explode(' ', $user->name)[0] ?? '') }}">
                    </div>
                </div>

                {{-- Last Name --}}
                <div class="sp-field-row">
                    <div class="sp-field-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><path d="M17 8.5C17 5.73858 14.7614 3.5 12 3.5C9.23858 3.5 7 5.73858 7 8.5C7 11.2614 9.23858 13.5 12 13.5C14.7614 13.5 17 11.2614 17 8.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M19 20.5C19 16.634 15.866 13.5 12 13.5C8.13401 13.5 5 16.634 5 20.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                        <div>
                            <div class="sp-field-title">Last Name</div>
                            <div class="sp-field-desc">Your last name as registered.</div>
                        </div>
                    </div>
                    <div class="sp-field-right">
                        <input type="text" name="last_name" class="form-input" placeholder="Last name" value="{{ old('last_name', explode(' ', $user->name)[1] ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Location & Settings Card --}}
        <div class="card" style="padding: 0;">
            <div class="sp-field-group">
                {{-- Country --}}
                <div class="sp-field-row">
                    <div class="sp-field-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle><path d="M12 8V12L14 14" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                        <div>
                            <div class="sp-field-title">Country</div>
                            <div class="sp-field-desc">Your registered country.</div>
                        </div>
                    </div>
                    <div class="sp-field-right">
                        <input type="text" class="form-input" value="{{ $user->country ?? 'TZ' }}" disabled>
                    </div>
                </div>

                {{-- Currency --}}
                <div class="sp-field-row">
                    <div class="sp-field-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle><path d="M12 8V12L14 14" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                        <div>
                            <div class="sp-field-title">Currency</div>
                            <div class="sp-field-desc">Your default currency.</div>
                        </div>
                    </div>
                    <div class="sp-field-right">
                        <input type="text" class="form-input" value="{{ $user->currency ?? 'TZS' }}" disabled>
                    </div>
                </div>

                {{-- Timezone --}}
                <div class="sp-field-row">
                    <div class="sp-field-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"></circle><path d="M12 8V12L14 14" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                        <div>
                            <div class="sp-field-title">Timezone</div>
                            <div class="sp-field-desc">Your local timezone.</div>
                        </div>
                    </div>
                    <div class="sp-field-right">
                        <input type="text" class="form-input" value="{{ $user->timezone ?? 'Africa/Dar_es_Salaam' }}" disabled>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Account Security Card (Email & Phone) --}}
        <div class="card" style="padding: 0;">
            <div class="sp-field-group">
                {{-- Email --}}
                <div class="sp-field-row">
                    <div class="sp-field-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><path d="M2 6L8.91302 9.91697C11.4616 11.361 12.5384 11.361 15.087 9.91697L22 6" stroke="currentColor" stroke-linejoin="round" stroke-width="1.5"></path><path d="M2.01577 13.4756C2.08114 16.5412 2.11383 18.0739 3.24496 19.2094C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.7551 19.2094C21.8862 18.0739 21.9189 16.5412 21.9842 13.4756C22.0053 12.4899 22.0053 11.5101 21.9842 10.5244C21.9189 7.45886 21.8862 5.92609 20.7551 4.79066C19.6239 3.65523 18.0497 3.61568 14.9012 3.53657C12.9607 3.48781 11.0393 3.48781 9.09882 3.53656C5.95033 3.61566 4.37608 3.65521 3.24495 4.79065C2.11382 5.92608 2.08114 7.45885 2.01576 10.5244C1.99474 11.5101 1.99475 12.4899 2.01577 13.4756Z" stroke="currentColor" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                        <div>
                            <div class="sp-field-title flex items-center gap-2">
                                Email
                                @if($user->email_verified_at)
                                    <span class="sp-badge-v flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="size-3"><path d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z" stroke="currentColor" stroke-width="1.5"></path><path d="M8 12.5L10.5 15L16 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>Verified</span>
                                @else
                                    <span class="sp-badge-nv flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="size-3"><path d="M18 6L6.00081 17.9992M17.9992 18L6 6.00085" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>Not Verified</span>
                                @endif
                            </div>
                            <div class="sp-field-desc">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="sp-field-right">
                        @if(!$user->email_verified_at)
                            <button type="button" class="btn btn-outline btn-sm w-full">Send Verification Email</button>
                        @endif
                    </div>
                </div>

                {{-- Phone --}}
                <div class="sp-field-row">
                    <div class="sp-field-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><path d="M12 19H12.01" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path><path d="M13.5 2H10.5C8.14298 2 6.96447 2 6.23223 2.73223C5.5 3.46447 5.5 4.64298 5.5 7V17C5.5 19.357 5.5 20.5355 6.23223 21.2678C6.96447 22 8.14298 22 10.5 22H16C18.8284 22 20.2426 22 21.1213 21.2678C22 20.5355 22 19.357 22 17V7C22 4.64298 22 4.75736 21.1213 3.87868C20.2426 3 18.8284 3 16 3Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                        <div>
                            <div class="sp-field-title flex items-center gap-2">
                                Phone
                                <span class="sp-badge-v flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="size-3"><path d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z" stroke="currentColor" stroke-width="1.5"></path><path d="M8 12.5L10.5 15L16 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>Verified</span>
                            </div>
                            <div class="sp-field-desc">{{ $user->phone ?? '+255613976254' }}</div>
                        </div>
                    </div>
                    <div class="sp-field-right"></div>
                </div>
            </div>
        </div>

        {{-- 4. Active Sessions Card --}}
        @php
            $currentSession = DB::table('sessions')->where('id', request()->session()->getId())->first();
        @endphp
        <div class="card" style="padding: 0;">
            <div class="card-header border-b border-muted" style="padding: 1rem 1.25rem;">
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="size-5 text-muted-foreground mt-0.5 shrink-0"><path d="M14 21H16M14 21C13.1716 21 12.5 20.3284 12.5 19.5V17L12 17M14 21H10M10 21H8M10 21C10.8284 21 11.5 20.3284 11.5 19.5V17L12 17M12 17V21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M16 3H8C5.17157 3 3.75736 3 2.87868 3.87868C2 4.75736 2 6.17157 2 9V11C2 13.8284 2 15.2426 2.87868 16.1213C3.75736 17 5.17157 17 8 17H16C18.8284 17 20.2426 17 21.1213 16.1213C22 15.2426 22 13.8284 22 11V9C22 6.17157 22 4.75736 21.1213 3.87868C20.2426 3 18.8284 3 16 3Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                    <div>
                        <h3 class="text-sm font-medium">Current Session</h3>
                        <p class="text-muted-foreground text-xs">The device you are currently using to access your account.</p>
                    </div>
                </div>
            </div>
            <div class="sp-field-group">
                @if($currentSession)
                <div class="flex items-center gap-4 px-6 py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" color="currentColor" class="size-5 text-muted-foreground shrink-0"><path d="M14 21H16M14 21C13.1716 21 12.5 20.3284 12.5 19.5V17L12 17M14 21H10M10 21H8M10 21C10.8284 21 11.5 20.3284 11.5 19.5V17L12 17M12 17V21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M16 3H8C5.17157 3 3.75736 3 2.87868 3.87868C2 4.75736 2 6.17157 2 9V11C2 13.8284 2 15.2426 2.87868 16.1213C3.75736 17 5.17157 17 8 17H16C18.8284 17 20.2426 17 21.1213 16.1213C22 15.2426 22 13.8284 22 11V9C22 6.17157 22 4.75736 21.1213 3.87868C20.2426 3 18.8284 3 16 3Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ $currentSession->user_agent }}</p>
                        <p class="text-muted-foreground text-xs">{{ $currentSession->ip_address }} · Active now</p>
                    </div>
                    <span class="sp-badge-v">Current</span>
                </div>
                @else
                <div class="px-6 py-8 text-center text-muted-foreground text-sm">Session information unavailable.</div>
                @endif
            </div>
        </div>

        <div class="flex justify-end pt-2">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>

    <div class="sp-profile-grid mt-4">
        <!-- Password Update -->
        <div class="card" style="padding: 0;">
            <div class="card-header border-b border-muted" style="padding: 1.25rem;">
                <h3 class="card-title">Update Password</h3>
            </div>
            <form action="{{ route('tyro-dashboard.profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body" style="padding: 0;">
                    <div class="sp-field-group">
                        <div class="sp-field-row">
                            <div class="sp-field-left">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><path d="M12 10V14" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M10 14H14" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M7 10V8a5 5 0 0 1 10 0v2" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M6 10h12a2 2 0 0 1 2 2v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5v-5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.5"/></svg>
                                <div>
                                    <div class="sp-field-title">Current Password</div>
                                    <div class="sp-field-desc">Confirm your current password.</div>
                                </div>
                            </div>
                            <div class="sp-field-right">
                                <input type="password" name="current_password" class="form-input" required>
                                @error('current_password') <span class="form-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="sp-field-row">
                            <div class="sp-field-left">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><path d="M12 10V14" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M10 14H14" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M7 10V8a5 5 0 0 1 10 0v2" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M6 10h12a2 2 0 0 1 2 2v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5v-5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.5"/></svg>
                                <div>
                                    <div class="sp-field-title">New Password</div>
                                    <div class="sp-field-desc">Choose a strong password.</div>
                                </div>
                            </div>
                            <div class="sp-field-right">
                                <input type="password" name="password" class="form-input" required>
                                @error('password') <span class="form-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="padding: 1.25rem;">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>

        <!-- Account Information -->
        <div class="card" style="padding: 1.25rem;">
            <div class="card-header" style="padding: 0; margin-bottom: 1.25rem;">
                <h3 class="card-title">Account Information</h3>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="form-label text-xs">Account ID</label>
                        <div class="sp-account-id-box mt-1">
                            <span id="account-id-text">#{{ $user->id }}</span>
                            <button type="button" class="copy-btn" onclick="copyToClipboard('#{{ $user->id }}', this)" title="Copy ID">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label text-xs">Member Since</label>
                            <p class="text-sm font-medium">{{ $user->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <label class="form-label text-xs">Status</label>
                            <p>
                                @if(method_exists($user, 'isSuspended') && $user->isSuspended())
                                    <span class="badge badge-danger">Suspended</span>
                                @else
                                    <span class="badge badge-success">Active</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text, btn) {
    navigator.clipboard.writeText(text).then(() => {
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--success)"><polyline points="20 6 9 17 4 12"></polyline></svg>';
        setTimeout(() => {
            btn.innerHTML = originalHtml;
        }, 2000);
    });
}
</script>
@endsection
