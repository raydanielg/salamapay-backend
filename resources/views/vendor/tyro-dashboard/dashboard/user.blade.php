@extends('tyro-dashboard::layouts.user')

@section('title', 'Dashboard')

@section('breadcrumb')
<span>Dashboard</span>
@endsection

@section('content')
<div class="dashboard-full-width">
    {{-- 1. Welcome Card (Full Width - Polished) --}}
    <div class="welcome-card">
        <div class="welcome-content">
            <div class="welcome-hello">
                Hello 👋✨
            </div>
            <h1 class="welcome-title">{{ $user->name }}, welcome back</h1>
            <p class="welcome-desc">
                You're inside <b>Salamapay</b>, your home for secure escrow services and growth.
            </p>
        </div>
    </div>
</div>

<div class="dashboard-grid-bottom">
    {{-- 2. SalamaPay Virtual Card --}}
    <div class="sp-virtual-card">
        <div class="sp-card-top">
            <div class="sp-card-brand">SalamaPay</div>
            <div class="sp-card-logo-box">
                <img src="/img/logo.png" alt="SalamaPay" class="sp-card-logo-img" onerror="this.style.display='none'; this.parentElement.innerHTML='LOGO';">
            </div>
        </div>

        <div class="sp-balance-section">
            <div class="sp-balance-title">Available Balance</div>
            <div class="sp-balance-amount">
                <span id="balanceAmount">••••••••</span>
                <button type="button" onclick="toggleBalance()" class="sp-balance-eye" aria-label="Toggle Balance">
                    <svg id="eyeIcon" class="size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1.2 4.03-6 9-6 1.108 0 2.13.24 3.046.633M19.735 10.612A13.087 13.087 0 0 1 21 12c0 1.2-4.03 6-9 6-1.188 0-2.187-.275-3.11-.718m3.11-8.282a3 3 0 0 1 3.11 4.682M9.19 14.726a3 3 0 0 1-1.581-2.726 3 3 0 0 1 1.031-2.274M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke="currentColor" stroke-width="2" d="m3 3 18 18"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="sp-card-number" id="cardNumber">
            •••• •••• •••• ••••
        </div>

        <div class="sp-card-footer">
            <div>
                <span class="sp-footer-label">CARD HOLDER</span>
                <p class="sp-footer-value">{{ strtoupper($user->name) }}</p>
            </div>

            <div>
                <span class="sp-footer-label">VALID THRU</span>
                <p class="sp-footer-value">09/32</p>
            </div>
        </div>

        <div class="sp-card-note">
            This is an online card for SalamaPay
        </div>
    </div>

    {{-- 3. Calendar Card --}}
    <div class="calendar-card">
        <div class="calendar-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" color="#059669" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            {{ date('F Y') }}
        </div>
        <div class="calendar-grid">
            <div class="calendar-day-label">S</div>
            <div class="calendar-day-label">M</div>
            <div class="calendar-day-label">T</div>
            <div class="calendar-day-label">W</div>
            <div class="calendar-day-label">T</div>
            <div class="calendar-day-label">F</div>
            <div class="calendar-day-label">S</div>
            
            @php
                $startOfMonth = now()->startOfMonth();
                $endOfMonth = now()->endOfMonth();
                $startDay = $startOfMonth->dayOfWeek;
                $daysInMonth = $startOfMonth->daysInMonth;
                $today = now()->day;
            @endphp

            @for ($i = 0; $i < $startDay; $i++)
                <div class="calendar-day"></div>
            @endfor

            @for ($day = 1; $day <= $daysInMonth; $day++)
                <div class="calendar-day {{ $day == $today ? 'today' : '' }}">
                    {{ $day }}
                </div>
            @endfor
        </div>
    </div>

    {{-- 4. Login Activity Card --}}
    <div class="login-activity-card">
        <div class="login-activity-header">
            <div class="login-activity-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a7 7 0 0 1 7 7v3a5 5 0 0 1-5 5H6a5 5 0 0 1-5-5V9a7 7 0 0 1 7-7"/><path d="M7 22h10"/><path d="M12 17v5"/></svg>
                Login Activity
            </div>
            <div class="login-activity-badge">Last 3</div>
        </div>

        @php
            $ip = request()->ip();
            $ua = request()->userAgent() ?? '';
            $device = str_contains(strtolower($ua), 'mobile') ? 'Mobile' : 'Web';
        @endphp

        <div class="login-activity-list">
            <div class="login-activity-item">
                <div class="login-activity-dot success"></div>
                <div class="login-activity-meta">
                    <div class="login-activity-line">
                        <span class="login-activity-strong">Current session</span>
                        <span class="login-activity-time">{{ now()->format('d M, H:i') }}</span>
                    </div>
                    <div class="login-activity-sub">{{ $device }} · {{ $ip }}</div>
                </div>
            </div>

            <div class="login-activity-item">
                <div class="login-activity-dot"></div>
                <div class="login-activity-meta">
                    <div class="login-activity-line">
                        <span class="login-activity-strong">Previous login</span>
                        <span class="login-activity-time">{{ now()->subHours(6)->format('d M, H:i') }}</span>
                    </div>
                    <div class="login-activity-sub">Web · 102.68.xxx.xxx</div>
                </div>
            </div>

            <div class="login-activity-item">
                <div class="login-activity-dot"></div>
                <div class="login-activity-meta">
                    <div class="login-activity-line">
                        <span class="login-activity-strong">Previous login</span>
                        <span class="login-activity-time">{{ now()->subDay()->format('d M, H:i') }}</span>
                    </div>
                    <div class="login-activity-sub">Mobile · 197.21.xxx.xxx</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- KPI Stats Grid --}}
<div class="sp-kpi-grid">
    {{-- Total Transaction --}}
    <div class="sp-kpi-card">
        <div class="sp-kpi-header">
            <div class="sp-kpi-icon total">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
        </div>
        <div class="sp-kpi-title">Total Transaction</div>
        <div class="sp-kpi-value">TZS 12.5M</div>
    </div>

    {{-- Pending Transaction --}}
    <div class="sp-kpi-card">
        <div class="sp-kpi-header">
            <div class="sp-kpi-icon pending">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
        </div>
        <div class="sp-kpi-title">Pending</div>
        <div class="sp-kpi-value">4</div>
    </div>

    {{-- Created Transaction --}}
    <div class="sp-kpi-card">
        <div class="sp-kpi-header">
            <div class="sp-kpi-icon created">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
            </div>
        </div>
        <div class="sp-kpi-title">Created</div>
        <div class="sp-kpi-value">28</div>
    </div>

    {{-- Completed Transaction --}}
    <div class="sp-kpi-card">
        <div class="sp-kpi-header">
            <div class="sp-kpi-icon completed">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11"/></svg>
            </div>
        </div>
        <div class="sp-kpi-title">Completed</div>
        <div class="sp-kpi-value">156</div>
    </div>

    {{-- Withdrawal Transaction --}}
    <div class="sp-kpi-card">
        <div class="sp-kpi-header">
            <div class="sp-kpi-icon withdrawal">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v10M16 8l-4 4-4-4M2 22h20"/></svg>
            </div>
        </div>
        <div class="sp-kpi-title">Withdrawals</div>
        <div class="sp-kpi-value">TZS 3.2M</div>
    </div>
</div>

<script>
let balanceVisible = false;
const originalBalance = "TZS 4,800,000";
const originalCardNumber = "5210 8843 9921 7745";

function toggleBalance(){
    const balance = document.getElementById("balanceAmount");
    const cardNumber = document.getElementById("cardNumber");
    const icon = document.getElementById("eyeIcon");

    if(balanceVisible){
        balance.textContent = "••••••••";
        cardNumber.textContent = "•••• •••• •••• ••••";
        icon.innerHTML = '<path stroke="currentColor" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1.2 4.03-6 9-6 1.108 0 2.13.24 3.046.633M19.735 10.612A13.087 13.087 0 0 1 21 12c0 1.2-4.03 6-9 6-1.188 0-2.187-.275-3.11-.718m3.11-8.282a3 3 0 0 1 3.11 4.682M9.19 14.726a3 3 0 0 1-1.581-2.726 3 3 0 0 1 1.031-2.274M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke="currentColor" stroke-width="2" d="m3 3 18 18"/>';
        balanceVisible = false;
    } else {
        balance.textContent = originalBalance;
        cardNumber.textContent = originalCardNumber;
        icon.innerHTML = '<path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/><path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>';
        balanceVisible = true;
    }
}
</script>
@endsection
