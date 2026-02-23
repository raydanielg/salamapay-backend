@extends('tyro-login::layouts.auth')

@section('content')
<div class="auth-container two-col">
    <div class="auth-grid">
        <div class="auth-left">
            <div class="form-card">
                <div class="logo-container">
                    @if($branding['logo'] ?? false)
                    <img src="{{ $branding['logo'] }}" alt="{{ $branding['app_name'] ?? config('app.name') }}">
                    @else
                    <div class="app-logo">
                        <svg viewBox="0 0 50 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068z" fill="currentColor" />
                        </svg>
                    </div>
                    @endif
                </div>

                <div class="form-header">
                    <h2>{{ $pageContent['title'] ?? 'Reset Password' }}</h2>
                    <p>{{ $pageContent['subtitle'] ?? 'Enter your new password below.' }}</p>
                </div>

                <div class="email-notice" style="text-align: center; margin-bottom: 1.5rem; padding: 1rem; background-color: var(--muted); border-radius: 0.5rem; border: 1px solid var(--border);">
                    <p style="color: var(--muted-foreground); font-size: 0.875rem; margin: 0;">Resetting password for:</p>
                    <p class="email-address" style="color: var(--foreground); font-weight: 600; font-size: 1rem; margin-top: 0.25rem;">{{ $email }}</p>
                </div>

                @if(session('error'))
                <div class="error-list">
                    <ul>
                        <li>{{ session('error') }}</li>
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('tyro-login.password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" required autocomplete="new-password" autofocus placeholder="New password" minlength="{{ config('tyro-login.password.min_length', 8) }}">
                        @error('password')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input @error('password_confirmation') is-invalid @enderror" required autocomplete="new-password" placeholder="Confirm new password">
                        @error('password_confirmation')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" style="margin-top: 0.5rem;">Reset Password</button>
                </form>

                <div class="form-footer">
                    <p>
                        <a href="{{ route('tyro-login.login') }}" class="form-link">Back to Login</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="auth-right">
            <div class="promo-card">
                <div class="promo-title">Set a stronger password</div>
                <div class="promo-desc">Choose a secure password to protect your Salamapay account and activity.</div>

                <div class="promo-list">
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Keep your escrow safe</div>
                            <div class="promo-item-desc">Account security helps protect projects, payments, and disputes.</div>
                        </div>
                    </div>
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Use a unique password</div>
                            <div class="promo-item-desc">Avoid reusing passwords from other apps.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection