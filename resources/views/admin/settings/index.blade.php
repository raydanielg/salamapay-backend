@extends('tyro-dashboard::layouts.app')

@section('title', 'System Settings')

@section('breadcrumb')
<a href="{{ route('tyro-dashboard.index') }}">Dashboard</a>
<span class="mx-2 text-slate-400">/</span>
<span class="text-slate-600 font-medium">Settings</span>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="page-header mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">System Settings</h1>
                <p class="text-slate-500 mt-1">Dhibiti mipangilio mikuu ya mfumo wa SalamaPay hapa.</p>
            </div>
            <div class="hidden md:block">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-100 uppercase tracking-wider">
                    Super Admin Access
                </span>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center gap-3 animate-fade-in">
        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 bg-rose-50 border border-rose-100 text-rose-700 rounded-2xl flex items-center gap-3">
        <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span class="font-medium">{{ session('error') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Navigation -->
        <div class="lg:col-span-3">
            <div class="sticky top-8 space-y-4">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <nav class="flex flex-col">
                        <a href="#general" class="nav-link-item active">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            General
                        </a>
                        <a href="#mail" class="nav-link-item">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Mail Configuration
                        </a>
                        <a href="#security" class="nav-link-item">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            Security
                        </a>
                    </nav>
                </div>
                <div class="bg-indigo-600 rounded-2xl p-6 text-white shadow-lg shadow-indigo-100 relative overflow-hidden">
                    <div class="relative z-10">
                        <h4 class="font-bold text-lg mb-2">Technical Support</h4>
                        <p class="text-indigo-100 text-sm mb-4">Unahitaji msaada? Timu ya IT ipo tayari kukusaidia masaa 24.</p>
                        <a href="mailto:support@zerixa.co.tz" class="inline-flex items-center px-4 py-2 bg-white text-indigo-600 rounded-xl font-bold text-sm hover:bg-indigo-50 transition-colors">
                            Contact Support
                        </a>
                    </div>
                    <svg class="absolute -right-4 -bottom-4 w-24 h-24 text-white opacity-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/></svg>
                </div>
            </div>
        </div>

        <!-- Forms Content -->
        <div class="lg:col-span-9 space-y-8">
            <!-- General Settings -->
            <section id="general" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden scroll-mt-8">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                        General Settings
                    </h3>
                </div>
                <form action="{{ route('tyro-dashboard.admin.settings.update') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Site Name</label>
                            <input type="text" name="site_name" value="{{ $settings['site_name'] }}" class="form-input-field">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Support Email</label>
                            <input type="email" name="contact_email" value="{{ $settings['contact_email'] }}" class="form-input-field">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Escrow Fee (%)</label>
                            <div class="relative">
                                <input type="number" step="0.1" name="fee" value="{{ $settings['escrow_fee_percentage'] }}" class="form-input-field pr-10">
                                <span class="absolute right-4 top-3 text-slate-400 font-bold">%</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Min. Escrow (TZS)</label>
                            <input type="number" name="min_amount" value="{{ $settings['min_escrow_amount'] }}" class="form-input-field">
                        </div>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="btn-primary-custom">Save Changes</button>
                    </div>
                </form>
            </section>

            <!-- Mail Settings -->
            <section id="mail" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden scroll-mt-8">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                        Mail Configuration (.env)
                    </h3>
                    <button type="button" onclick="document.getElementById('test-mail-form').submit();" class="text-indigo-600 hover:text-indigo-700 font-bold text-sm flex items-center gap-2 group transition-all">
                        <svg class="w-4 h-4 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Send Test Email
                    </button>
                </div>
                <form action="{{ route('tyro-dashboard.admin.settings.update') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Mail Mailer</label>
                            <input type="text" name="mail_mailer" value="{{ $settings['mail_mailer'] }}" class="form-input-field bg-slate-50 opacity-70 cursor-not-allowed" readonly title="Huwezi kubadilisha mailer hapa">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Mail Host</label>
                            <input type="text" name="mail_host" value="{{ $settings['mail_host'] }}" class="form-input-field">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Mail Port</label>
                            <input type="text" name="mail_port" value="{{ $settings['mail_port'] }}" class="form-input-field">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Encryption</label>
                            <select name="mail_encryption" class="form-input-field">
                                <option value="ssl" {{ $settings['mail_encryption'] == 'ssl' ? 'selected' : '' }}>SSL</option>
                                <option value="tls" {{ $settings['mail_encryption'] == 'tls' ? 'selected' : '' }}>TLS</option>
                                <option value="" {{ $settings['mail_encryption'] == '' ? 'selected' : '' }}>None</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Mail Username</label>
                            <input type="text" name="mail_username" value="{{ $settings['mail_username'] }}" class="form-input-field font-mono text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Mail Password</label>
                            <input type="password" name="mail_password" value="{{ $settings['mail_password'] }}" class="form-input-field font-mono text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">From Address</label>
                            <input type="email" name="mail_from_address" value="{{ $settings['mail_from_address'] }}" class="form-input-field">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">From Name</label>
                            <input type="text" name="mail_from_name" value="{{ $settings['mail_from_name'] }}" class="form-input-field">
                        </div>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="btn-primary-custom">Update Mail Config</button>
                    </div>
                </form>
            </section>

            <!-- System Toggles -->
            <section class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                        System Controls
                    </h3>
                </div>
                <div class="p-8 space-y-6 divide-y divide-slate-100">
                    <div class="flex items-center justify-between pb-6">
                        <div>
                            <h4 class="font-bold text-slate-800">User Registration</h4>
                            <p class="text-sm text-slate-500">Ruhusu au zuia watumiaji wapya kujiunga na SalamaPay.</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="flex items-center justify-between py-6">
                        <div>
                            <h4 class="font-bold text-slate-800">Maintenance Mode</h4>
                            <p class="text-sm text-slate-500">Weka mfumo kwenye hali ya matengenezo (Admin pekee ndio wataona).</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="flex items-center justify-between pt-6">
                        <div>
                            <h4 class="font-bold text-slate-800">SMS Notifications</h4>
                            <p class="text-sm text-slate-500">Tuma ujumbe mfupi wa simu kwa miamala yote mipya.</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider slider-green"></span>
                        </label>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<form id="test-mail-form" action="{{ route('tyro-dashboard.admin.settings.test-mail') }}" method="POST" style="display: none;">
    @csrf
</form>

<style>
    .nav-link-item {
        padding: 1rem;
        border-left: 4px solid transparent;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.2s ease;
        font-weight: 500;
        text-decoration: none;
    }
    .nav-link-item:hover {
        background-color: #f8fafc;
        color: #0f172a;
    }
    .nav-link-item.active {
        border-left-color: #4f46e5;
        background-color: #f5f3ff;
        color: #4338ca;
        font-weight: 700;
    }
    .form-input-field {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
        outline: none;
        color: #0f172a;
    }
    .form-input-field:focus {
        ring: 4px solid rgba(79, 70, 229, 0.1);
        border-color: #4f46e5;
    }
    .btn-primary-custom {
        background-color: #4f46e5;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 0.75rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .btn-primary-custom:hover {
        background-color: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Switch Component */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #e2e8f0;
        transition: .4s;
        border-radius: 34px;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 18px; width: 18px;
        left: 4px; bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    input:checked + .slider { background-color: #4f46e5; }
    input:checked + .slider.slider-green { background-color: #10b981; }
    input:checked + .slider:before { transform: translateX(24px); }
</style>

<script>
    // Simple scroll spy behavior
    document.querySelectorAll('.nav-link-item').forEach(link => {
        link.addEventListener('click', function(e) {
            document.querySelectorAll('.nav-link-item').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endsection
