@extends('tyro-dashboard::layouts.app')

@section('title', 'System Settings')

@section('breadcrumb')
<a href="{{ route('tyro-dashboard.index') }}">Dashboard</a>
<span class="mx-2">/</span>
<span>Settings</span>
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-row">
        <div>
            <h1 class="page-title">System Settings</h1>
            <p class="page-description">Dhibiti mipangilio mikuu ya mfumo wa SalamaPay hapa.</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
    <!-- Sidebar Settings Nav -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <nav class="flex flex-col">
                <a href="#general" class="p-4 border-l-4 border-indigo-600 bg-indigo-50 text-indigo-700 font-bold flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    General Settings
                </a>
                <a href="#security" class="p-4 border-l-4 border-transparent hover:bg-slate-50 text-slate-600 flex items-center gap-3 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    Security & Access
                </a>
                <a href="#notifications" class="p-4 border-l-4 border-transparent hover:bg-slate-50 text-slate-600 flex items-center gap-3 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    Notifications
                </a>
                <a href="#api" class="p-4 border-l-4 border-transparent hover:bg-slate-50 text-slate-600 flex items-center gap-3 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    API & Webhooks
                </a>
            </nav>
        </div>

        <div class="mt-6 bg-indigo-600 rounded-2xl p-6 text-white shadow-lg shadow-indigo-200">
            <h4 class="font-bold text-lg mb-2">Msaada?</h4>
            <p class="text-indigo-100 text-sm mb-4">Kama unahitaji msaada wa kiufundi kurekebisha mipangilio hii, wasiliana na timu ya IT.</p>
            <a href="#" class="inline-flex items-center gap-2 bg-white text-indigo-600 px-4 py-2 rounded-xl font-bold text-sm hover:bg-indigo-50 transition-colors">
                Wasiliana nasi
            </a>
        </div>
    </div>

    <!-- Settings Forms -->
    <div class="lg:col-span-2 space-y-8">
        <!-- General Section -->
        <div id="general" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
            <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                General Settings
            </h3>
            
            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Site Name</label>
                        <input type="text" name="site_name" value="{{ $settings['site_name'] }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Support Email</label>
                        <input type="email" name="contact_email" value="{{ $settings['contact_email'] }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Escrow Fee (%)</label>
                        <div class="relative">
                            <input type="number" step="0.1" name="fee" value="{{ $settings['escrow_fee_percentage'] }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                            <span class="absolute right-4 top-3.5 text-slate-400">%</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Min. Escrow (TZS)</label>
                        <input type="number" name="min_amount" value="{{ $settings['min_escrow_amount'] }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Toggles Section -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
            <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                System Controls
            </h3>
            
            <div class="divide-y divide-slate-100">
                <div class="py-4 flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-slate-800">User Registration</h4>
                        <p class="text-sm text-slate-500">Ruhusu au zuia watumiaji wapya kujiunga.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                    </label>
                </div>

                <div class="py-4 flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-slate-800">Maintenance Mode</h4>
                        <p class="text-sm text-slate-500">Weka mfumo kwenye matengenezo.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                </div>

                <div class="py-4 flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-slate-800">SMS Notifications</h4>
                        <p class="text-sm text-slate-500">Tuma ujumbe mfupi wa simu kwa miamala.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
