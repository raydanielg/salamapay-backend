<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Read real SMTP settings from .env via config
        $settings = [
            'site_name' => config('app.name', 'SalamaPay'),
            'contact_email' => 'support@salamapay.com',
            'escrow_fee_percentage' => 2.5,
            'min_escrow_amount' => 1000,
            'maintenance_mode' => false,
            'allow_registration' => true,
            'sms_notifications' => true,
            'email_notifications' => true,
            // Mail Settings from .env
            'mail_mailer' => config('mail.default'),
            'mail_host' => config('mail.mailers.smtp.host'),
            'mail_port' => config('mail.mailers.smtp.port'),
            'mail_username' => config('mail.mailers.smtp.username'),
            'mail_password' => config('mail.mailers.smtp.password'),
            'mail_encryption' => config('mail.mailers.smtp.encryption'),
            'mail_from_address' => config('mail.from.address'),
            'mail_from_name' => config('mail.from.name'),
        ];

        return view('admin.settings.index', [
            'user' => $user,
            'settings' => $settings,
            'isAdmin' => true
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'mail_host' => 'nullable|string',
            'mail_port' => 'nullable|string',
            'mail_encryption' => 'nullable|string',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_from_address' => 'nullable|email',
            'mail_from_name' => 'nullable|string',
        ]);

        if ($request->has('mail_host')) {
            $this->updateEnv([
                'MAIL_HOST' => $data['mail_host'],
                'MAIL_PORT' => $data['mail_port'],
                'MAIL_ENCRYPTION' => $data['mail_encryption'],
                'MAIL_USERNAME' => $data['mail_username'],
                'MAIL_PASSWORD' => $data['mail_password'],
                'MAIL_FROM_ADDRESS' => $data['mail_from_address'],
                'MAIL_FROM_NAME' => '"' . $data['mail_from_name'] . '"',
            ]);
            
            \Illuminate\Support\Facades\Artisan::call('config:clear');
        }

        return back()->with('success', 'Mipangilio imesasishwa kikamilifu kwenye .env!');
    }

    protected function updateEnv(array $data)
    {
        $path = base_path('.env');
        if (!file_exists($path)) return;

        $content = file_get_contents($path);

        foreach ($data as $key => $value) {
            $oldValue = env($key);
            $pattern = "/^{$key}=.*/m";
            $replacement = "{$key}={$value}";

            if (preg_match($pattern, $content)) {
                $content = preg_replace($pattern, $replacement, $content);
            } else {
                $content .= "\n{$key}={$value}";
            }
        }

        file_put_contents($path, $content);
    }
}
