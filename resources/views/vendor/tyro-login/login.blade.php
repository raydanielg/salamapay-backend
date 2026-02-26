@extends('tyro-login::layouts.auth')

@section('title', 'Login')
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
                            <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z" fill="currentColor" />
                        </svg>
                    </div>
                    @endif
                </div>

                <div class="form-header">
                    <h2>Welcome to Salamapay</h2>
                    @if(($loginField ?? 'email') === 'both')
                    <p>Login with email/username and password to manage your escrow projects.</p>
                    @elseif(($loginField ?? 'email') === 'username')
                    <p>Login with username and password to manage your escrow projects.</p>
                    @else
                    <p>Login with email and password to manage your escrow projects.</p>
                    @endif
                </div>

                @if(session('success'))
                <div class="alert alert-success" style="padding: 0.875rem 1rem; margin-bottom: 1.5rem; background-color: #d1fae5; border: 1px solid #6ee7b7; border-radius: 0.5rem; color: #065f46; font-size: 0.9375rem;">
                    {{ session('success') }}
                </div>
                @endif

                <form method="POST" action="{{ route('tyro-login.login.submit') }}">
                    @csrf

                    @if(($loginField ?? 'email') === 'both')
                    <div class="form-group">
                        <label for="login" class="form-label">Email or Username</label>
                        <input type="text" id="login" name="login" class="form-input @error('login') is-invalid @enderror" value="{{ old('login') }}" required autocomplete="username" autofocus placeholder="Email or username">
                        @error('login')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    @elseif(($loginField ?? 'email') === 'username')
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-input @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                        @error('username')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    @else
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email@example.com">
                        @error('email')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="Password">
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <svg class="eye-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-options">
                        @if($features['remember_me'] ?? true)
                        <div class="checkbox-group">
                            <input type="checkbox" id="remember" name="remember" class="checkbox-input" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="checkbox-label">Remember me</label>
                        </div>
                        @else
                        <div></div>
                        @endif

                        @if($features['forgot_password'] ?? true)
                        <a href="{{ route('tyro-login.password.request') }}" class="form-link">Forgot password?</a>
                        @endif
                    </div>

                    @if($captchaEnabled ?? false)
                    <div class="form-group captcha-group">
                        <label for="captcha_answer" class="form-label">{{ $captchaConfig['label'] ?? 'Security Check' }}</label>
                        <div class="captcha-container">
                            <span class="captcha-question">{{ $captchaQuestion }}</span>
                            <input type="number" id="captcha_answer" name="captcha_answer" class="form-input captcha-input @error('captcha_answer') is-invalid @enderror" required autocomplete="off" placeholder="{{ $captchaConfig['placeholder'] ?? 'Enter the answer' }}">
                        </div>
                        @error('captcha_answer')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif

                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>

                @if($registrationEnabled ?? true)
                <div class="form-footer">
                    <p>
                        Don't have an account?
                        <a href="{{ route('tyro-login.register') }}" class="form-link">Sign up</a>
                    </p>
                </div>
                @endif

                @include('tyro-login::partials.social-login', ['action' => 'login'])
            </div>
        </div>

        <div class="auth-right">
            <div class="promo-card">
                <div class="promo-title">Secure escrow payments for projects</div>
                <div class="promo-desc">Create projects, hire providers, and release funds only when work is approved — all in one place.</div>

                <div class="promo-list">
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Projects & milestones</div>
                            <div class="promo-item-desc">Track progress from proposal to completion with clear status updates.</div>
                        </div>
                    </div>
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Escrow protection</div>
                            <div class="promo-item-desc">Funds stay protected while work is delivered — release only when you’re satisfied.</div>
                        </div>
                    </div>
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Disputes & resolution</div>
                            <div class="promo-item-desc">If issues happen, disputes can be raised and resolved with an audit trail.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
    }
</script>
@endsection