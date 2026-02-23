@if (session('success'))
<div class="alert alert-success" role="alert">
    <svg class="alert-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
    </svg>
    <p class="alert-text"><span class="alert-title-inline">Success!</span> {{ session('success') }}</p>
</div>
@endif

@if (session('error'))
<div class="alert alert-error" role="alert">
    <svg class="alert-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
    </svg>
    <p class="alert-text"><span class="alert-title-inline">Danger!</span> {{ session('error') }}</p>
</div>
@endif

@if (session('warning'))
<div class="alert alert-warning" role="alert">
    <svg class="alert-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
    </svg>
    <p class="alert-text"><span class="alert-title-inline">Warning!</span> {{ session('warning') }}</p>
</div>
@endif

@if (session('info'))
<div class="alert alert-info" role="alert">
    <svg class="alert-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
    </svg>
    <p class="alert-text"><span class="alert-title-inline">Info!</span> {{ session('info') }}</p>
</div>
@endif

@if ($errors->any() && config('tyro-dashboard.resource_ui.show_global_errors', true))
<div class="alert alert-error" role="alert">
    <svg class="alert-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
    </svg>
    <div class="alert-content">
        <p class="alert-text"><span class="alert-title-inline">Danger!</span> Please correct the following errors.</p>
        <ul class="alert-list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
