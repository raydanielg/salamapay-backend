<?php

namespace App\Http\Controllers;

use App\Models\AuthPageDeviceKey;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AccessKeyController extends Controller
{
    public function show(Request $request): View
    {
        return view('auth.access-key', [
            'next' => $request->query('next', '/login'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $masterKey = env('AUTH_PAGE_KEY');

        $request->validate([
            'key' => ['required', 'string'],
            'next' => ['nullable', 'string'],
        ]);

        if (!is_string($masterKey) || $masterKey === '' || !hash_equals($masterKey, (string) $request->input('key'))) {
            return back()->withInput()->withErrors([
                'key' => 'Invalid access key.',
            ]);
        }

        $cookieName = 'auth_page_device_key';
        $plainToken = Str::random(64);
        $tokenHash = hash('sha256', $plainToken);

        $ttlDays = (int) env('AUTH_PAGE_DEVICE_KEY_TTL_DAYS', 30);
        $expiresAt = CarbonImmutable::now()->addDays(max(1, $ttlDays));

        AuthPageDeviceKey::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'token_hash' => $tokenHash,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'last_used_at' => now(),
            'expires_at' => $expiresAt,
            'revoked' => false,
        ]);

        Cookie::queue(
            Cookie::make(
                $cookieName,
                $plainToken,
                $expiresAt->diffInMinutes(CarbonImmutable::now()),
                '/',
                null,
                $request->isSecure(),
                true,
                false,
                'Lax'
            )
        );

        session(['auth_page_access' => true]);

        $next = (string) $request->input('next', '/login');
        if ($next === '' || $next[0] !== '/' || str_starts_with($next, '//')) {
            $next = '/login';
        }

        return redirect()->to($next);
    }
}
