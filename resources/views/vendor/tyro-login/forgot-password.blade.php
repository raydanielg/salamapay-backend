@extends('tyro-login::layouts.auth')

@section('title', 'Forgot Password')
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
                            <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.45.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068z" fill="currentColor" />
                        </svg>
                    </div>
                    @endif
                </div>

                <div class="form-header">
                    <h2>{{ $pageContent['title'] ?? 'Forgot Password?' }}</h2>
                    <p>{{ $pageContent['subtitle'] ?? 'Enter your email and we\'ll send you a reset link.' }}</p>
                </div>

                @if(session('success'))
                <div class="alert alert-success" style="padding: 0.875rem 1rem; margin-bottom: 1.5rem; background-color: #d1fae5; border: 1px solid #6ee7b7; border-radius: 0.5rem; color: #065f46; font-size: 0.9375rem;">
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

                <form method="POST" action="{{ route('tyro-login.password.email') }}">
                    @csrf

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
                            <input type="text" id="phone" name="phone" class="phone-input-field" value="{{ old('phone') }}" required autocomplete="tel" placeholder="7XXXXXXXX" autofocus>
                            
                            <div class="country-dropdown-menu" id="country-menu">
                                <div class="country-search-container">
                                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <input type="text" class="country-search-input" id="country-search" placeholder="Search country...">
                                </div>
                                <div class="country-list" id="country-list">
                                    <div class="country-item loading">Loading...</div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 0.375rem; font-size: 0.8125rem; color: var(--muted-foreground);">We'll send a verification code to this number</div>
                        @error('phone')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Send Verification Code</button>
                </form>

                <div class="form-footer">
                    <p>
                        Remember your password?
                        <a href="{{ route('tyro-login.login') }}" class="form-link">Back to Login</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="auth-right">
            <div class="promo-card">
                <div class="promo-title">Account recovery made simple</div>
                <div class="promo-desc">We’ll send a secure reset link to your email so you can get back to managing escrow projects.</div>

                <div class="promo-list">
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Secure reset link</div>
                            <div class="promo-item-desc">Your password is never sent — only a secure reset link.</div>
                        </div>
                    </div>
                    <div class="promo-item">
                        <div class="promo-dot"></div>
                        <div>
                            <div class="promo-item-title">Back to business</div>
                            <div class="promo-item-desc">Continue managing projects, escrow, and disputes once recovered.</div>
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
        const forgotForm = document.querySelector('form[action*="password"]');

        let allCountries = [];
        let selectedCode = '255';

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            wrapper.classList.toggle('open');
            if (wrapper.classList.contains('open')) searchInput.focus();
        });

        document.addEventListener('click', () => wrapper.classList.remove('open'));
        menu.addEventListener('click', (e) => e.stopPropagation());

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
            });

        function renderList(countries) {
            listContainer.innerHTML = '';
            countries.forEach(country => {
                const item = document.createElement('div');
                item.className = 'country-item';
                if (country.code === selectedCode) item.classList.add('selected');
                item.innerHTML = `<img src="${country.flag}" class="item-flag"> <span class="item-name">${country.name}</span> <span class="item-code">+${country.code}</span>`;
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

        searchInput.addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase();
            const filtered = allCountries.filter(c => c.name.toLowerCase().includes(term) || c.code.includes(term));
            renderList(filtered);
        });

        if (forgotForm) {
            forgotForm.addEventListener('submit', function() {
                const cleanPhone = phoneInput.value.replace(/\D/g, '');
                phoneInput.value = selectedCode + cleanPhone;
            });
        }
    });
</script>
@endsection