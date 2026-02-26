@extends('tyro-dashboard::layouts.user')

@section('title', 'Two-Factor Authentication')

@section('breadcrumb')
<span>Settings</span>
<span class="breadcrumb-separator">/</span>
<span>2FA</span>
@endsection

@section('content')
<div class="dashboard-full-width">
    <div class="tx-table-shell">
        <div class="tx-table-toolbar" style="border-bottom: 0;">
            <div class="tx-toolbar-left">
                <div class="tx-table-title">Two-factor authentication</div>
            </div>
        </div>

        <div class="empty-state" style="margin-top: 0;">
            <div class="empty-state-title">Coming soon</div>
            <div class="empty-state-description">2FA settings will be available here.</div>
        </div>
    </div>
</div>
@endsection
