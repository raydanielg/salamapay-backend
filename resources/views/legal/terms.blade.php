@extends('tyro-login::layouts.auth')

@section('title', 'Terms of Service')
@section('content')
<div class="auth-container centered">
    <div class="form-card" style="max-width: 800px;">
        <div class="logo-container">
            <img src="{{ asset('salama-pay-logo.png') }}" alt="Salamapay" style="height: 80px;">
        </div>

        <div class="form-header">
            <h2>Terms of Service</h2>
            <p>Last updated: {{ date('F d, Y') }}</p>
        </div>

        <div class="legal-content" style="text-align: left; color: var(--foreground); line-height: 1.8; max-height: 60vh; overflow-y: auto; padding-right: 1rem; margin-bottom: 2rem;">
            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">1. Introduction</h3>
            <p style="margin-bottom: 1.5rem;">Welcome to Salamapay. By using our services, you agree to these terms. Please read them carefully. Salamapay provides a secure escrow payment platform to facilitate trust between clients and service providers.</p>

            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">2. Escrow Services</h3>
            <p style="margin-bottom: 1.5rem;">Salamapay holds funds securely until the agreed-upon conditions of a transaction are met. Funds are only released when the client approves the work or according to the dispute resolution outcomes.</p>

            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">3. User Obligations</h3>
            <p style="margin-bottom: 1.5rem;">Users must provide accurate information and maintain the security of their accounts. Any fraudulent activity will lead to immediate account suspension and potential legal action.</p>

            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">4. Fees</h3>
            <p style="margin-bottom: 1.5rem;">Salamapay charges a service fee for facilitating secure transactions. These fees are clearly displayed before you commit to any payment or project.</p>

            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">5. Dispute Resolution</h3>
            <p style="margin-bottom: 1.5rem;">In case of a disagreement, Salamapay provides a mediation process. Our goal is to reach a fair outcome based on the evidence provided by both parties.</p>
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
