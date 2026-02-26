<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Mock settings data
        $settings = [
            'site_name' => config('app.name', 'SalamaPay'),
            'contact_email' => 'support@salamapay.com',
            'escrow_fee_percentage' => 2.5,
            'min_escrow_amount' => 1000,
            'maintenance_mode' => false,
            'allow_registration' => true,
            'sms_notifications' => true,
            'email_notifications' => true,
        ];

        return view('admin.settings.index', [
            'user' => $user,
            'settings' => $settings,
            'isAdmin' => true
        ]);
    }

    public function update(Request $request)
    {
        // Logic to update settings would go here
        return back()->with('success', 'Mipangilio imesajiliwa kikamilifu!');
    }
}
