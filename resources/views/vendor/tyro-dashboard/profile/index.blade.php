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

    <div class="sp-profile-grid">
    <!-- Profile Information -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Profile Information</h3>
        </div>
        <form action="{{ route('tyro-dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body" style="padding: 0;">
                @if((config('tyro-dashboard.features.profile_photo_upload') && method_exists($user, 'hasProfilePhotoColumn') && $user->hasProfilePhotoColumn()) || (config('tyro-dashboard.features.gravatar') && method_exists($user, 'hasGravatarColumn') && $user->hasGravatarColumn()))
                <div class="sp-field-group">
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
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" style="width: 64px; height: 64px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border);">
                        @else
                            <div style="width: 64px; height: 64px; border-radius: 50%; background: var(--primary); color: var(--primary-foreground); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 600;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        
                        <div style="flex: 1;">
                            @if(config('tyro-dashboard.features.profile_photo_upload') && method_exists($user, 'hasProfilePhotoColumn') && $user->hasProfilePhotoColumn())
                                <input type="file" name="photo" class="form-input" style="padding: 0.5rem;" accept="image/*">
                                <p class="form-hint">Allowed types: jpg, png, gif, webp. Max size: {{ config('tyro-dashboard.profile_photo.max_size', 10240) / 1024 }}MB.</p>
                            @endif
                        </div>
                            </div>

                            @if(method_exists($user, 'hasProfilePhotoColumn') && $user->hasProfilePhotoColumn() && $user->profile_photo_path)
                                <div style="margin-top: 0.75rem;">
                                    <button type="button" class="btn btn-sm btn-ghost" style="color: var(--danger); padding: 0.25rem 0.5rem;" onclick="showDanger('Remove Photo', 'Are you sure you want to remove your profile photo?').then(confirmed => { if(confirmed) document.getElementById('delete-photo-form').submit(); })">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px; margin-right: 4px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Remove Photo
                                    </button>
                                </div>
                            @endif

                    @if(config('tyro-dashboard.features.gravatar') && method_exists($user, 'hasGravatarColumn') && $user->hasGravatarColumn())
                            <div class="form-check" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.75rem;">
                                <input type="checkbox" id="use_gravatar" name="use_gravatar" value="1" {{ old('use_gravatar', $user->use_gravatar) ? 'checked' : '' }}>
                                <label for="use_gravatar" style="margin-bottom: 0;">Use Gravatar</label>
                            </div>
                    @endif
                        </div>
                    </div>
                </div>
                @endif

                <div class="sp-field-group">
                    <div class="sp-field-row">
                        <div class="sp-field-left">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><path d="M17 8.5C17 5.73858 14.7614 3.5 12 3.5C9.23858 3.5 7 5.73858 7 8.5C7 11.2614 9.23858 13.5 12 13.5C14.7614 13.5 17 11.2614 17 8.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M19 20.5C19 16.634 15.866 13.5 12 13.5C8.13401 13.5 5 16.634 5 20.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                            <div>
                                <div class="sp-field-title">Name</div>
                                <div class="sp-field-desc">Your display name.</div>
                            </div>
                        </div>
                        <div class="sp-field-right">
                            <input type="text" id="name" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="sp-field-row">
                        <div class="sp-field-left">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><path d="M2 6L8.91302 9.91697C11.4616 11.361 12.5384 11.361 15.087 9.91697L22 6" stroke="currentColor" stroke-linejoin="round" stroke-width="1.5"></path><path d="M2.01577 13.4756C2.08114 16.5412 2.11383 18.0739 3.24496 19.2094C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.7551 19.2094C21.8862 18.0739 21.9189 16.5412 21.9842 13.4756C22.0053 12.4899 22.0053 11.5101 21.9842 10.5244C21.9189 7.45886 21.8862 5.92609 20.7551 4.79066C19.6239 3.65523 18.0497 3.61568 14.9012 3.53657C12.9607 3.48781 11.0393 3.48781 9.09882 3.53656C5.95033 3.61566 4.37608 3.65521 3.24495 4.79065C2.11382 5.92608 2.08114 7.45885 2.01576 10.5244C1.99474 11.5101 1.99475 12.4899 2.01577 13.4756Z" stroke="currentColor" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                            <div>
                                <div class="sp-field-title">Email</div>
                                <div class="sp-field-desc">
                                    @if($user->email_verified_at)
                                        Verified on {{ $user->email_verified_at->format('M d, Y') }}.
                                    @else
                                        Not verified.
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="sp-field-right">
                            <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    <!-- Update Password -->
    <div class="card">
        <div class="card-header">
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
                                <div class="sp-field-desc">Confirm your current password to continue.</div>
                            </div>
                        </div>
                        <div class="sp-field-right">
                            <input type="password" id="current_password" name="current_password" class="form-input @error('current_password') is-invalid @enderror" required>
                            @error('current_password')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="sp-field-row">
                        <div class="sp-field-left">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><path d="M12 10V14" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M10 14H14" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M7 10V8a5 5 0 0 1 10 0v2" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M6 10h12a2 2 0 0 1 2 2v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5v-5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.5"/></svg>
                            <div>
                                <div class="sp-field-title">New Password</div>
                                <div class="sp-field-desc">Choose a strong new password.</div>
                            </div>
                        </div>
                        <div class="sp-field-right">
                            <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="sp-field-row">
                        <div class="sp-field-left">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sp-field-icon"><path d="M12 10V14" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M10 14H14" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M7 10V8a5 5 0 0 1 10 0v2" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"/><path d="M6 10h12a2 2 0 0 1 2 2v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5v-5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.5"/></svg>
                            <div>
                                <div class="sp-field-title">Confirm Password</div>
                                <div class="sp-field-desc">Re-type your new password.</div>
                            </div>
                        </div>
                        <div class="sp-field-right">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </form>
    </div>

    </div>

    <!-- Two-Factor Authentication -->
    <form id="delete-photo-form" action="{{ route('tyro-dashboard.profile.photo.delete') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@if(config('tyro-login.two_factor.enabled'))
    <div class="card" style="margin-top: 1.5rem;">
        <div class="card-header">
            <h3 class="card-title">Two-Factor Authentication (2FA)</h3>
        </div>
        <div class="card-body">
            @if($user->two_factor_secret)
                <p style="margin-bottom: 1rem; color: var(--muted-foreground);">
                    Two-factor authentication is currently <strong>enabled</strong> for your account.
                </p>
                <form action="{{ route('tyro-dashboard.profile.2fa.reset') }}" method="POST" id="reset-profile-2fa-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-warning" onclick="event.preventDefault(); showConfirm('Reset 2FA', 'Are you sure you want to reset your 2FA? You will need to set it up again.').then(confirmed => { if(confirmed) document.getElementById('reset-profile-2fa-form').submit(); })">
                        Reset 2FA Configuration
                    </button>
                </form>
            @else
                <p style="margin-bottom: 1rem; color: var(--muted-foreground);">
                    Two-factor authentication is currently <strong>disabled</strong> for your account.
                </p>
                
                <button type="button" class="btn btn-secondary" disabled>Reset 2FA Configuration</button>
            @endif
        </div>
    </div>
    @endif

<!-- Account Information -->
<div class="card" style="margin-top: 1.5rem;">
    <div class="card-header">
        <h3 class="card-title">Account Information</h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
            <div>
                <label class="form-label" style="margin-bottom: 0.25rem;">Account ID</label>
                <p style="font-size: 0.875rem; color: var(--muted-foreground);">#{{ $user->id }}</p>
            </div>
            <div>
                <label class="form-label" style="margin-bottom: 0.25rem;">Member Since</label>
                <p style="font-size: 0.875rem; color: var(--muted-foreground);">{{ $user->created_at->format('F d, Y') }}</p>
            </div>
            @if(method_exists($user, 'roles') && $user->roles->count())
            <div>
                <label class="form-label" style="margin-bottom: 0.25rem;">Roles</label>
                <div class="badge-list">
                    @foreach($user->roles as $role)
                        <span class="badge badge-primary">{{ $role->name }}</span>
                    @endforeach
                </div>
            </div>
            @endif
            <div>
                <label class="form-label" style="margin-bottom: 0.25rem;">Status</label>
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
@endsection
