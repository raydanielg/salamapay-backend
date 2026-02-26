@extends('tyro-login::layouts.auth')

@section('title', 'Privacy Policy')
@section('content')
<div class="auth-container centered">
    <div class="form-card" style="max-width: 800px;">
        <div class="logo-container">
            <img src="{{ asset('salama-pay-logo.png') }}" alt="Salamapay" style="height: 80px;">
        </div>

        <div class="form-header">
            <h2>Privacy Policy</h2>
            <p>Last updated: {{ date('F d, Y') }}</p>
        </div>

        <div class="legal-content" style="text-align: left; color: var(--foreground); line-height: 1.8; max-height: 60vh; overflow-y: auto; padding-right: 1rem; margin-bottom: 2rem;">
            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">1. Data Collection</h3>
            <p style="margin-bottom: 1.5rem;">We collect information you provide directly to us, such as when you create an account, make a payment, or communicate with our support team. This includes your name, email, phone number, and payment information.</p>

            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">2. Use of Information</h3>
            <p style="margin-bottom: 1.5rem;">We use your information to provide, maintain, and improve our services, process transactions, and send you technical notices and support messages.</p>

            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">3. Data Security</h3>
            <p style="margin-bottom: 1.5rem;">We implement industry-standard security measures to protect your personal data and payment information. Your financial data is encrypted and handled through secure payment gateways.</p>

            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">4. Information Sharing</h3>
            <p style="margin-bottom: 1.5rem;">We do not sell your personal data. We only share information necessary to complete your transactions or as required by law.</p>

            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">5. Your Choices</h3>
            <p style="margin-bottom: 1.5rem;">You can update your account information at any time through your dashboard settings. You also have the right to request the deletion of your personal data, subject to legal requirements.</p>
        </div>

        <div class="form-footer">
            <a href="{{ route('tyro-login.register') }}" class="btn btn-primary">Back to Registration</a>
        </div>
    </div>
</div>

<style>
    .legal-content::-webkit-scrollbar {
        width: 6px;
    }
    .legal-content::-webkit-scrollbar-track {
        background: transparent;
    }
    .legal-content::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 10px;
    }
</style>
@endsection
