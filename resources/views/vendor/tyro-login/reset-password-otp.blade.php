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
                            <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.60.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z" fill="currentColor" />
                        </svg>
                    </div>
                    @endif
                </div>

                <div class="form-header">
                    <h2>Reset your password</h2>
                    <p>Enter the 6-digit code sent to your phone and your new password.</p>
                </div>

                @if(session('success'))
                <div class="alert alert-success" style="padding: 0.875rem 1rem; margin-bottom: 1.5rem; background-color: #d1fae5; border: 1px solid #6ee7b7; border-radius: 0.5rem; color: #065f46; font-size: 0.9375rem; text-align: center;">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="error-list">
                    <ul>
                        <li>{{ session('error') }}</li>
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('tyro-login.password.reset.otp.submit') }}" id="otp-form">
                    @csrf
                    <input type="hidden" name="phone_otp" id="full_phone_otp">

                    <div class="otp-input-group">
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric" autofocus>
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric">
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric">
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric">
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric">
                        <input type="text" class="otp-box" maxlength="1" pattern="\d*" inputmode="numeric">
                    </div>

                    @error('phone_otp')
                    <div class="error-message" style="text-align: center; margin-bottom: 1rem;">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="password" class="form-label">New Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" required placeholder="New password" minlength="{{ config('tyro-login.password.min_length', 8) }}">
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

                    <button type="submit" class="btn btn-primary" style="margin-top: 0.5rem;">Reset Password</button>
                </form>

                <div class="form-footer">
                    <p>
                        Remembered your password? 
                        <a href="{{ route('tyro-login.login') }}" class="form-link">Back to login</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="auth-right">
            <div class="promo-card">
                <div class="promo-title">Secure account recovery</div>
                <div class="promo-desc">Salamapay uses phone verification to ensure that only you can reset your account password.</div>

                <div class="promo-list">
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Protect your funds</div>
                            <div class="promo-item-desc">Secure recovery helps keep your escrow projects and transactions safe.</div>
                        </div>
                    </div>
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Instant access</div>
                            <div class="promo-item-desc">Verify via SMS and set a new password to get back to work immediately.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const boxes = document.querySelectorAll('.otp-box');
        const fullOtpInput = document.getElementById('full_phone_otp');

        boxes.forEach((box, index) => {
            box.addEventListener('input', (e) => {
                if (e.target.value.length > 1) {
                    e.target.value = e.target.value.slice(0, 1);
                }
                
                if (e.target.value && index < boxes.length - 1) {
                    boxes[index + 1].focus();
                }
                
                updateHiddenInput();
            });

            box.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    boxes[index - 1].focus();
                }
            });

            box.addEventListener('paste', (e) => {
                e.preventDefault();
                const data = e.clipboardData.getData('text').slice(0, boxes.length);
                if (!/^\d+$/.test(data)) return;

                data.split('').forEach((char, i) => {
                    if (boxes[i]) {
                        boxes[i].value = char;
                    }
                });
                
                if (data.length === boxes.length) {
                    boxes[boxes.length - 1].focus();
                } else {
                    boxes[data.length].focus();
                }
                
                updateHiddenInput();
            });
        });

        function updateHiddenInput() {
            let otp = '';
            boxes.forEach(box => otp += box.value);
            fullOtpInput.value = otp;
        }
    });

    function togglePassword(id) {
        const input = document.getElementById(id);
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
    }
</script>
@endsection
