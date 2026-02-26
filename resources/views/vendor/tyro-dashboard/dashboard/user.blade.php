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
    {{-- SalamaPay Virtual Card Only --}}
    <div class="sp-virtual-card">
        <div class="sp-card-top">
            <div class="sp-card-brand">SalamaPay</div>
            <div class="sp-logo-box">LOGO</div>
        </div>
        
        <div class="sp-balance-section">
            <div class="sp-balance-label">Available Balance</div>
            <div class="sp-balance-row">
                <div class="sp-balance-amount" id="cardBalance">••••••••</div>
                <button class="sp-balance-eye" onclick="toggleBalance()">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                </button>
            </div>
        </div>

        <div class="sp-card-number" id="cardNumber">•••• •••• •••• ••••</div>

        <div class="sp-card-footer">
            <div class="sp-footer-item">
                <span class="sp-footer-label">CARD HOLDER</span>
                <p class="sp-footer-value">{{ auth()->user()->name }}</p>
            </div>
            <div class="sp-footer-item">
                <span class="sp-footer-label">VALID THRU</span>
                <p class="sp-footer-value">09/32</p>
            </div>
        </div>

        <div class="sp-card-note">This is an online card for SalamaPay</div>
    </div>
</div>

{{-- Transaction History Table --}}
<div class="transaction-section">
    <div class="transaction-header">
        <h2 class="transaction-title">Transaction History</h2>
        <div class="transaction-filters">
            <div class="tx-range-tabs" role="tablist" aria-label="Transaction range">
                <button class="tx-tab" type="button" data-range="today" onclick="setTxRange('today')">Today</button>
                <button class="tx-tab" type="button" data-range="7" onclick="setTxRange(7)">7D</button>
                <button class="tx-tab active" type="button" data-range="30" onclick="setTxRange(30)">30D</button>
                <button class="tx-tab" type="button" data-range="90" onclick="setTxRange(90)">90D</button>
            </div>
        </div>
    </div>
    
    <div class="transaction-table-container">
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>Transaction</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr data-date="2024-12-15">
                    <td>
                        <div class="transaction-info">
                            <div class="transaction-icon incoming">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2v20M17 7l-5-5-5 5"/>
                                </svg>
                            </div>
                            <div>
                                <div class="transaction-name">Payment from John Doe</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-neutral">Incoming</span></td>
                    <td class="transaction-date">Dec 15, 2024</td>
                    <td class="transaction-amount positive">+TZS 250,000</td>
                </tr>
                <tr data-date="2024-12-14">
                    <td>
                        <div class="transaction-info">
                            <div class="transaction-icon outgoing">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22V2M7 17l5 5 5-5"/>
                                </svg>
                            </div>
                            <div>
                                <div class="transaction-name">Withdrawal to Bank</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-neutral">Outgoing</span></td>
                    <td class="transaction-date">Dec 14, 2024</td>
                    <td class="transaction-amount negative">-TZS 100,000</td>
                </tr>
                <tr data-date="2024-12-13">
                    <td>
                        <div class="transaction-info">
                            <div class="transaction-icon incoming">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2v20M17 7l-5-5-5 5"/>
                                </svg>
                            </div>
                            <div>
                                <div class="transaction-name">Payment from Jane Smith</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-neutral">Incoming</span></td>
                    <td class="transaction-date">Dec 13, 2024</td>
                    <td class="transaction-amount positive">+TZS 180,000</td>
                </tr>
                <tr data-date="2024-12-12">
                    <td>
                        <div class="transaction-info">
                            <div class="transaction-icon outgoing">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22V2M7 17l5 5 5-5"/>
                                </svg>
                            </div>
                            <div>
                                <div class="transaction-name">Payment to Mike Wilson</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-neutral">Outgoing</span></td>
                    <td class="transaction-date">Dec 12, 2024</td>
                    <td class="transaction-amount negative">-TZS 50,000</td>
                </tr>
                <tr data-date="2024-12-10">
                    <td>
                        <div class="transaction-info">
                            <div class="transaction-icon incoming">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2v20M17 7l-5-5-5 5"/>
                                </svg>
                            </div>
                            <div>
                                <div class="transaction-name">Refund from Vendor</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-neutral">Incoming</span></td>
                    <td class="transaction-date">Dec 10, 2024</td>
                    <td class="transaction-amount positive">+TZS 75,000</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="recent-payments-section" id="recentPayments">
    <div class="recent-payments-header">
        <div class="recent-payments-title">Recent Payments</div>
        <div class="recent-payments-actions">
            <div class="columns-wrapper">
                <button class="rp-btn" type="button" id="rpColumnsBtn" onclick="toggleRpColumnsMenu()">Columns</button>
                <div class="columns-menu" id="rpColumnsMenu" aria-hidden="true">
                    <label class="columns-item"><input type="checkbox" data-col="reference" checked> Reference</label>
                    <label class="columns-item"><input type="checkbox" data-col="customer" checked> Customer</label>
                    <label class="columns-item"><input type="checkbox" data-col="amount" checked> Amount</label>
                    <label class="columns-item"><input type="checkbox" data-col="fee"> Fee</label>
                    <label class="columns-item"><input type="checkbox" data-col="net"> Net</label>
                    <label class="columns-item"><input type="checkbox" data-col="status" checked> Status</label>
                    <label class="columns-item"><input type="checkbox" data-col="type"> Type</label>
                    <label class="columns-item"><input type="checkbox" data-col="created"> Created</label>
                </div>
            </div>
            <button class="rp-btn secondary" type="button">View All</button>
        </div>
    </div>

    <div class="transaction-table-container">
        <table class="transaction-table" id="recentPaymentsTable">
            <thead>
                <tr>
                    <th class="rp-col-reference" data-col="reference">Reference</th>
                    <th class="rp-col-customer" data-col="customer">Customer</th>
                    <th class="rp-col-amount" data-col="amount">Amount</th>
                    <th class="rp-col-fee" data-col="fee">Fee</th>
                    <th class="rp-col-net" data-col="net">Net</th>
                    <th class="rp-col-status" data-col="status">Status</th>
                    <th class="rp-col-type" data-col="type">Type</th>
                    <th class="rp-col-created" data-col="created">Created</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="rp-col-reference" data-col="reference">SP-2024-00125</td>
                    <td class="rp-col-customer" data-col="customer">John Doe</td>
                    <td class="rp-col-amount" data-col="amount">TZS 250,000</td>
                    <td class="rp-col-fee" data-col="fee">TZS 2,000</td>
                    <td class="rp-col-net" data-col="net">TZS 248,000</td>
                    <td class="rp-col-status" data-col="status"><span class="badge badge-neutral">Completed</span></td>
                    <td class="rp-col-type" data-col="type"><span class="badge badge-neutral">Incoming</span></td>
                    <td class="rp-col-created" data-col="created">2024-12-15</td>
                </tr>
                <tr>
                    <td class="rp-col-reference" data-col="reference">SP-2024-00124</td>
                    <td class="rp-col-customer" data-col="customer">Jane Smith</td>
                    <td class="rp-col-amount" data-col="amount">TZS 180,000</td>
                    <td class="rp-col-fee" data-col="fee">TZS 1,500</td>
                    <td class="rp-col-net" data-col="net">TZS 178,500</td>
                    <td class="rp-col-status" data-col="status"><span class="badge badge-neutral">Pending</span></td>
                    <td class="rp-col-type" data-col="type"><span class="badge badge-neutral">Incoming</span></td>
                    <td class="rp-col-created" data-col="created">2024-12-13</td>
                </tr>
                <tr>
                    <td class="rp-col-reference" data-col="reference">SP-2024-00123</td>
                    <td class="rp-col-customer" data-col="customer">Mike Wilson</td>
                    <td class="rp-col-amount" data-col="amount">TZS 50,000</td>
                    <td class="rp-col-fee" data-col="fee">TZS 800</td>
                    <td class="rp-col-net" data-col="net">TZS 49,200</td>
                    <td class="rp-col-status" data-col="status"><span class="badge badge-neutral">Completed</span></td>
                    <td class="rp-col-type" data-col="type"><span class="badge badge-neutral">Outgoing</span></td>
                    <td class="rp-col-created" data-col="created">2024-12-12</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
let balanceVisible = false;
const originalBalance = "TZS 4,800,000";
const originalCardNumber = "5210 8843 9921 7745";

function toggleBalance(){
    const balance = document.getElementById("cardBalance");
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

function setTxRange(range) {
    const rows = document.querySelectorAll('.transaction-table tbody tr[data-date]');
    if (!rows || rows.length === 0) return;

    document.querySelectorAll('.tx-range-tabs .tx-tab').forEach((btn) => {
        btn.classList.remove('active');
    });

    const activeBtn = document.querySelector('.tx-range-tabs .tx-tab[data-range="' + String(range) + '"]');
    if (activeBtn) activeBtn.classList.add('active');

    let latest = null;
    rows.forEach((row) => {
        const iso = row.getAttribute('data-date');
        if (!iso) return;
        const d = new Date(iso + 'T12:00:00');
        if (!latest || d > latest) latest = d;
    });

    if (!latest) return;

    let minDate = null;
    if (range === 'today') {
        minDate = new Date(latest);
        minDate.setHours(0, 0, 0, 0);
    } else {
        const days = parseInt(range, 10);
        if (!Number.isNaN(days)) {
            minDate = new Date(latest);
            minDate.setDate(minDate.getDate() - (days - 1));
            minDate.setHours(0, 0, 0, 0);
        }
    }

    rows.forEach((row) => {
        const iso = row.getAttribute('data-date');
        if (!iso) return;
        const d = new Date(iso + 'T12:00:00');
        row.style.display = (!minDate || d >= minDate) ? '' : 'none';
    });
}

function toggleRpColumnsMenu() {
    const menu = document.getElementById('rpColumnsMenu');
    if (!menu) return;
    const isOpen = menu.classList.contains('open');
    if (isOpen) {
        menu.classList.remove('open');
        menu.setAttribute('aria-hidden', 'true');
    } else {
        menu.classList.add('open');
        menu.setAttribute('aria-hidden', 'false');
    }
}

function setRpColumnVisibility(colKey, isVisible) {
    const table = document.getElementById('recentPaymentsTable');
    if (!table) return;
    table.querySelectorAll('[data-col="' + colKey + '"]').forEach((cell) => {
        cell.classList.toggle('col-hidden', !isVisible);
    });
}

function initRecentPaymentsColumns() {
    const menu = document.getElementById('rpColumnsMenu');
    if (!menu) return;

    const isMobile = window.matchMedia && window.matchMedia('(max-width: 640px)').matches;
    const visible = isMobile
        ? ['reference', 'amount', 'status']
        : ['reference', 'customer', 'amount', 'status'];

    menu.querySelectorAll('input[type="checkbox"][data-col]').forEach((cb) => {
        const col = cb.getAttribute('data-col');
        const shouldShow = visible.includes(col);
        cb.checked = shouldShow;
        setRpColumnVisibility(col, shouldShow);
    });
}

document.addEventListener('change', function (e) {
    const t = e.target;
    if (!(t instanceof HTMLInputElement)) return;
    if (t.closest('#rpColumnsMenu') && t.dataset && t.dataset.col) {
        setRpColumnVisibility(t.dataset.col, t.checked);
    }
});

document.addEventListener('click', function (e) {
    const menu = document.getElementById('rpColumnsMenu');
    const btn = document.getElementById('rpColumnsBtn');
    if (!menu || !btn) return;
    if (!menu.classList.contains('open')) return;
    const target = e.target;
    if (target === btn || menu.contains(target)) return;
    menu.classList.remove('open');
    menu.setAttribute('aria-hidden', 'true');
});

document.addEventListener('DOMContentLoaded', function () {
    initRecentPaymentsColumns();
});
</script>
@endsection
