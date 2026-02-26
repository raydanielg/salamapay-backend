@extends('tyro-login::layouts.auth')

@section('title', 'Register')
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
                    <h2>Create your Salamapay account</h2>
                    <p>Sign up and start using secure escrow payments for your projects.</p>
                </div>

                <form method="POST" action="{{ route('tyro-login.register.submit') }}">
                    @csrf

                    @if(request()->query('invite') ?? $inviteHash ?? null)
                    <input type="hidden" name="invite" value="{{ request()->query('invite') ?? $inviteHash }}">
                    @endif

                    <div class="name-row">
                        <div class="form-group">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-input @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required autocomplete="given-name" autofocus placeholder="First name">
                            @error('first_name')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-input @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required autocomplete="family-name" placeholder="Last name">
                            @error('last_name')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" placeholder="email@example.com">
                        @error('email')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="custom-country-selector" id="phone-wrapper">
                            <div class="country-trigger" id="country-trigger">
                                <img id="selected-flag" class="trigger-flag" src="https://flagcdn.com/w40/tz.png" alt="TZ">
                                <span id="selected-code" class="trigger-code">+255</span>
                                <svg class="trigger-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <input type="text" id="phone" name="phone" class="phone-input-field" value="{{ old('phone') }}" required autocomplete="tel" placeholder="7XXXXXXXX">
                            
                            <div class="country-dropdown-menu" id="country-menu">
                                <div class="country-search-container">
                                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <input type="text" class="country-search-input" id="country-search" placeholder="Search country...">
                                </div>
                                <div class="country-list" id="country-list">
                                    <!-- Populated by JS -->
                                    <div class="country-item loading">Loading...</div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="full_phone" id="full_phone">
                        <div style="margin-top: 0.375rem; font-size: 0.8125rem; color: var(--muted-foreground);">We'll send a verification code to this number</div>
                        @error('phone')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="Password" minlength="{{ config('tyro-login.password.min_length', 8) }}">
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

                <div class="form-group" style="margin-top: 0.25rem;">
                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" name="terms" class="checkbox-input" {{ old('terms') ? 'checked' : '' }} required>
                        <label for="terms" class="checkbox-label">
                            I agree to the <a href="{{ route('terms') }}" target="_blank" class="form-link">terms of service</a> and <a href="{{ route('privacy') }}" target="_blank" class="form-link">privacy policy</a>
                        </label>
                    </div>
                    @error('terms')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 0.5rem;">Create account</button>
                </form>

                <div class="form-footer">
                    <p>
                        Already have an account?
                        <a href="{{ route('tyro-login.login') }}" class="form-link">Log in</a>
                    </p>
                </div>

                @include('tyro-login::partials.social-login', ['action' => 'register'])
            </div>
        </div>

        <div class="auth-right">
            <div class="promo-card">
                <div class="promo-title">Build trust between clients and providers</div>
                <div class="promo-desc">Salamapay uses escrow to protect both sides — clients pay securely, providers deliver confidently.</div>

                <div class="promo-list">
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Projects & milestones</div>
                            <div class="promo-item-desc">Track project progress with clear status updates from proposal to completion.</div>
                        </div>
                    </div>
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Escrow protection</div>
                            <div class="promo-item-desc">Funds are released only after work is completed and approved.</div>
                        </div>
                    </div>
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Disputes & resolution</div>
                            <div class="promo-item-desc">Raise disputes when needed and keep a transparent audit trail.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('phone-wrapper');
        const trigger = document.getElementById('country-trigger');
        const menu = document.getElementById('country-menu');
        const searchInput = document.getElementById('country-search');
        const listContainer = document.getElementById('country-list');
        const flagImg = document.getElementById('selected-flag');
        const codeSpan = document.getElementById('selected-code');
        const phoneInput = document.getElementById('phone');
        const fullPhoneInput = document.getElementById('full_phone');
        const registerForm = document.querySelector('form[action*="register"]');

        let allCountries = [];
        let selectedCode = '255';

        // Toggle dropdown
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            wrapper.classList.toggle('open');
            if (wrapper.classList.contains('open')) {
                searchInput.focus();
            }
        });

        // Close on outside click
        document.addEventListener('click', () => wrapper.classList.remove('open'));
        menu.addEventListener('click', (e) => e.stopPropagation());

        // Fetch countries
        axios.get('https://restcountries.com/v3.1/all?fields=name,flags,idd')
            .then(response => {
                allCountries = response.data
                    .filter(c => c.idd.root)
                    .map(c => ({
                        name: c.name.common,
                        code: c.idd.root.replace('+', '') + (c.idd.suffixes ? c.idd.suffixes[0] : ''),
                        flag: c.flags.png
                    }))
                    .sort((a, b) => a.name.localeCompare(b.name));
                
                renderList(allCountries);
            })
            .catch(err => {
                console.error('Error fetching countries:', err);
                listContainer.innerHTML = '<div class="country-item">Failed to load countries</div>';
            });

        function renderList(countries) {
            listContainer.innerHTML = '';
            countries.forEach(country => {
                const item = document.createElement('div');
                item.className = 'country-item';
                if (country.code === selectedCode) item.classList.add('selected');
                
                item.innerHTML = `
                    <img src="${country.flag}" class="item-flag" alt="${country.name}">
                    <span class="item-name">${country.name}</span>
                    <span class="item-code">+${country.code}</span>
                `;
                
                item.addEventListener('click', () => {
                    selectedCode = country.code;
                    flagImg.src = country.flag;
                    codeSpan.textContent = `+${country.code}`;
                    wrapper.classList.remove('open');
                    phoneInput.focus();
                });
                
                listContainer.appendChild(item);
            });
        }

        // Search logic
        searchInput.addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase();
            const filtered = allCountries.filter(c => 
                c.name.toLowerCase().includes(term) || 
                c.code.includes(term)
            );
            renderList(filtered);
        });

        // Form submission: concatenate code + phone
        if (registerForm) {
            registerForm.addEventListener('submit', function() {
                const cleanPhone = phoneInput.value.replace(/\D/g, ''); // numbers only
                // We update the original phone input or use the hidden field
                // Many backends expect 'phone' to be the full number
                fullPhoneInput.value = selectedCode + cleanPhone;
                // If you want the backend to receive the full number in 'phone' field:
                phoneInput.value = selectedCode + cleanPhone;
            });
        }
    });

    function togglePassword(id) {
        const input = document.getElementById(id);
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
    }
</script>
@endsection