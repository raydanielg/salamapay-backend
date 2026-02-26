@extends('tyro-dashboard::layouts.user')

@section('title', 'Transactions')

@section('breadcrumb')
<span>Transactions</span>
@endsection

@section('content')
<div class="dashboard-full-width transactions-page">
    <div class="tx-table-shell">
        <div class="tx-table-toolbar">
            <div class="tx-toolbar-left">
                <div class="tx-range-tabs" role="tablist" aria-label="Transaction status">
                    <button class="tx-tab active" type="button" data-status="all" onclick="setTxStatus('all')">All</button>
                    <button class="tx-tab" type="button" data-status="pending" onclick="setTxStatus('pending')">Pending</button>
                    <button class="tx-tab" type="button" data-status="completed" onclick="setTxStatus('completed')">Completed</button>
                    <button class="tx-tab" type="button" data-status="failed" onclick="setTxStatus('failed')">Failed</button>
                </div>

                <div class="search-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21 21-4.3-4.3"/><circle cx="11" cy="11" r="8"/></svg>
                    <input class="form-input" id="txSearch" placeholder="Search by reference..." />
                </div>
            </div>

            <div class="tx-toolbar-right">
                <div class="columns-wrapper">
                    <button class="rp-btn" type="button" id="txPageColumnsBtn" onclick="toggleTxPageColumnsMenu()">Columns</button>
                    <div class="columns-menu" id="txPageColumnsMenu" aria-hidden="true">
                        <label class="columns-item"><input type="checkbox" data-col="reference" checked> Reference</label>
                        <label class="columns-item"><input type="checkbox" data-col="party" checked> Party</label>
                        <label class="columns-item"><input type="checkbox" data-col="category" checked> Category</label>
                        <label class="columns-item"><input type="checkbox" data-col="direction" checked> Direction</label>
                        <label class="columns-item"><input type="checkbox" data-col="amount" checked> Amount</label>
                        <label class="columns-item"><input type="checkbox" data-col="fee" checked> Fee</label>
                        <label class="columns-item"><input type="checkbox" data-col="status" checked> Status</label>
                        <label class="columns-item"><input type="checkbox" data-col="created"> Created</label>
                    </div>
                </div>
                <button class="rp-btn success" type="button">New Payment</button>
            </div>
        </div>

        <div class="tx-table-subtoolbar">
            <div class="tx-range-tabs" role="tablist" aria-label="Transaction range">
                <button class="tx-tab" type="button" data-range="today" onclick="setTxRange('today')">Today</button>
                <button class="tx-tab" type="button" data-range="7" onclick="setTxRange(7)">7D</button>
                <button class="tx-tab active" type="button" data-range="30" onclick="setTxRange(30)">30D</button>
                <button class="tx-tab" type="button" data-range="90" onclick="setTxRange(90)">90D</button>
            </div>
        </div>

    <div class="transaction-table-container">
        <table class="transaction-table" id="txPageTable">
            <thead>
                <tr>
                    <th data-col="reference">Reference</th>
                    <th data-col="party">Party</th>
                    <th data-col="category">Category</th>
                    <th data-col="direction">Direction</th>
                    <th data-col="amount">Amount</th>
                    <th data-col="fee">Fee</th>
                    <th data-col="status">Status</th>
                    <th data-col="created" class="transaction-date">Created</th>
                </tr>
            </thead>
            <tbody>
                <tr data-date="2024-12-15" data-status="completed">
                    <td data-col="reference">SP-2024-00125</td>
                    <td data-col="party">John Doe</td>
                    <td data-col="category">Service Escrow</td>
                    <td data-col="direction"><span class="badge badge-neutral">Incoming</span></td>
                    <td data-col="amount" class="transaction-amount positive">+TZS 250,000</td>
                    <td data-col="fee">TZS 2,000</td>
                    <td data-col="status"><span class="badge badge-neutral">Completed</span></td>
                    <td data-col="created" class="transaction-date">2024-12-15</td>
                </tr>
                <tr data-date="2024-12-14" data-status="completed">
                    <td data-col="reference">SP-2024-00124</td>
                    <td data-col="party">CRDB Bank</td>
                    <td data-col="category">Payout</td>
                    <td data-col="direction"><span class="badge badge-neutral">Outgoing</span></td>
                    <td data-col="amount" class="transaction-amount negative">-TZS 100,000</td>
                    <td data-col="fee">TZS 1,500</td>
                    <td data-col="status"><span class="badge badge-neutral">Completed</span></td>
                    <td data-col="created" class="transaction-date">2024-12-14</td>
                </tr>
                <tr data-date="2024-12-13" data-status="pending">
                    <td data-col="reference">SP-2024-00123</td>
                    <td data-col="party">Jane Smith</td>
                    <td data-col="category">Product Escrow</td>
                    <td data-col="direction"><span class="badge badge-neutral">Incoming</span></td>
                    <td data-col="amount" class="transaction-amount positive">+TZS 180,000</td>
                    <td data-col="fee">TZS 1,200</td>
                    <td data-col="status"><span class="badge badge-neutral">Pending</span></td>
                    <td data-col="created" class="transaction-date">2024-12-13</td>
                </tr>
                <tr data-date="2024-12-12" data-status="failed">
                    <td data-col="reference">SP-2024-00122</td>
                    <td data-col="party">Mike Wilson</td>
                    <td data-col="category">Service Escrow</td>
                    <td data-col="direction"><span class="badge badge-neutral">Outgoing</span></td>
                    <td data-col="amount" class="transaction-amount negative">-TZS 50,000</td>
                    <td data-col="fee">TZS 800</td>
                    <td data-col="status"><span class="badge badge-neutral">Failed</span></td>
                    <td data-col="created" class="transaction-date">2024-12-12</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="empty-state" id="txEmptyState" style="display:none;">
        <div class="empty-state-illustration" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="92" height="92" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h10"/><path d="M7 11h10"/><path d="M7 15h6"/><path d="M6 3h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H9l-5 3V5a2 2 0 0 1 2-2Z"/></svg>
        </div>
        <div class="empty-state-title">No transactions yet</div>
        <div class="empty-state-description">Transactions will show up here once you start collecting.</div>
    </div>

    <div class="table-pagination" id="txPagination" aria-label="Transactions pagination">
        <div class="pagination-meta" id="txPaginationMeta">0 results</div>
        <div class="pagination-controls">
            <button class="page-btn" type="button" id="txPrevBtn" onclick="txGoPrev()">Prev</button>
            <div class="page-numbers" id="txPageNumbers"></div>
            <button class="page-btn" type="button" id="txNextBtn" onclick="txGoNext()">Next</button>
        </div>
    </div>

</div>

</div>

<script>
let txRange = 30;
let txStatus = 'all';
let txSearch = '';
let txPage = 1;
const txPerPage = 8;

function setTxRange(range) {
    txRange = range;
    txPage = 1;
    document.querySelectorAll('.tx-table-subtoolbar .tx-range-tabs .tx-tab').forEach((btn) => {
        btn.classList.remove('active');
    });
    const activeBtn = document.querySelector('.tx-table-subtoolbar .tx-range-tabs .tx-tab[data-range="' + String(range) + '"]');
    if (activeBtn) activeBtn.classList.add('active');
    applyTxFilters();
}

function setTxStatus(status) {
    txStatus = status;
    txPage = 1;
    document.querySelectorAll('.tx-toolbar-left .tx-range-tabs .tx-tab').forEach((btn) => {
        btn.classList.remove('active');
    });
    const activeBtn = document.querySelector('.tx-toolbar-left .tx-range-tabs .tx-tab[data-status="' + String(status) + '"]');
    if (activeBtn) activeBtn.classList.add('active');
    applyTxFilters();
}

function applyTxFilters() {
    const rows = document.querySelectorAll('#txPageTable tbody tr[data-date]');
    if (!rows || rows.length === 0) return;

    let latest = null;
    rows.forEach((row) => {
        const iso = row.getAttribute('data-date');
        if (!iso) return;
        const d = new Date(iso + 'T12:00:00');
        if (!latest || d > latest) latest = d;
    });

    let minDate = null;
    if (latest) {
        if (txRange === 'today') {
            minDate = new Date(latest);
            minDate.setHours(0, 0, 0, 0);
        } else {
            const days = parseInt(txRange, 10);
            if (!Number.isNaN(days)) {
                minDate = new Date(latest);
                minDate.setDate(minDate.getDate() - (days - 1));
                minDate.setHours(0, 0, 0, 0);
            }
        }
    }

    const q = (txSearch || '').toLowerCase().trim();

    const matching = [];
    rows.forEach((row) => {
        const iso = row.getAttribute('data-date');
        const status = row.getAttribute('data-status');
        const referenceCell = row.querySelector('[data-col="reference"]');
        const reference = referenceCell ? referenceCell.textContent || '' : '';

        const d = iso ? new Date(iso + 'T12:00:00') : null;
        const okRange = !minDate || (d && d >= minDate);
        const okStatus = txStatus === 'all' || status === txStatus;
        const okSearch = q === '' || reference.toLowerCase().includes(q);

        const ok = (okRange && okStatus && okSearch);
        row.style.display = ok ? '' : 'none';
        if (ok) matching.push(row);
    });

    applyTxPagination(matching);
}

function applyTxPagination(matchingRows) {
    const total = matchingRows.length;
    const totalPages = Math.max(1, Math.ceil(total / txPerPage));
    if (txPage > totalPages) txPage = totalPages;
    if (txPage < 1) txPage = 1;

    matchingRows.forEach((row, idx) => {
        const start = (txPage - 1) * txPerPage;
        const end = start + txPerPage;
        const show = idx >= start && idx < end;
        row.style.display = show ? '' : 'none';
    });

    renderTxPagination(total, totalPages);

    const empty = document.getElementById('txEmptyState');
    const container = document.querySelector('.transactions-page .transaction-table-container');
    if (empty && container) {
        const showEmpty = total === 0;
        empty.style.display = showEmpty ? '' : 'none';
        container.style.display = showEmpty ? 'none' : '';
    }
}

function renderTxPagination(total, totalPages) {
    const meta = document.getElementById('txPaginationMeta');
    const numbers = document.getElementById('txPageNumbers');
    const prev = document.getElementById('txPrevBtn');
    const next = document.getElementById('txNextBtn');
    if (!meta || !numbers || !prev || !next) return;

    meta.textContent = total === 1 ? '1 result' : total + ' results';
    prev.disabled = txPage <= 1;
    next.disabled = txPage >= totalPages;

    numbers.innerHTML = '';
    const start = Math.max(1, txPage - 2);
    const end = Math.min(totalPages, txPage + 2);

    for (let p = start; p <= end; p++) {
        const b = document.createElement('button');
        b.type = 'button';
        b.className = 'page-btn' + (p === txPage ? ' active' : '');
        b.textContent = String(p);
        b.addEventListener('click', function () {
            txPage = p;
            applyTxFilters();
        });
        numbers.appendChild(b);
    }
}

function txGoPrev() {
    if (txPage <= 1) return;
    txPage -= 1;
    applyTxFilters();
}

function txGoNext() {
    txPage += 1;
    applyTxFilters();
}

function toggleTxPageColumnsMenu() {
    const menu = document.getElementById('txPageColumnsMenu');
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

function setTxPageColumnVisibility(colKey, isVisible) {
    const table = document.getElementById('txPageTable');
    if (!table) return;
    table.querySelectorAll('[data-col="' + colKey + '"]').forEach((cell) => {
        cell.classList.toggle('col-hidden', !isVisible);
    });
}

document.addEventListener('change', function (e) {
    const t = e.target;
    if (!(t instanceof HTMLInputElement)) return;
    if (t.closest('#txPageColumnsMenu') && t.dataset && t.dataset.col) {
        setTxPageColumnVisibility(t.dataset.col, t.checked);
    }
});

document.addEventListener('click', function (e) {
    const menu = document.getElementById('txPageColumnsMenu');
    const btn = document.getElementById('txPageColumnsBtn');
    if (!menu || !btn) return;
    if (!menu.classList.contains('open')) return;
    const target = e.target;
    if (target === btn || menu.contains(target)) return;
    menu.classList.remove('open');
    menu.setAttribute('aria-hidden', 'true');
});

document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('txSearch');
    if (search) {
        search.addEventListener('input', function () {
            txSearch = search.value || '';
            txPage = 1;
            applyTxFilters();
        });
    }

    setTxStatus('all');
    setTxRange(30);

    const menu = document.getElementById('txPageColumnsMenu');
    if (menu) {
        menu.querySelectorAll('input[type="checkbox"][data-col]').forEach((cb) => {
            setTxPageColumnVisibility(cb.getAttribute('data-col'), cb.checked);
        });
    }
});
</script>
@endsection
