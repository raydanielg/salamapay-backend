<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AuthPageDeviceKey;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class SecureAuthPageMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cookieName = 'auth_page_device_key';

        if (!$request->isMethod('get')) {
            return $next($request);
        }

        if (session('auth_page_access') === true) {
            return $next($request);
        }

        $cookieToken = $request->cookie($cookieName);
        if (is_string($cookieToken) && $cookieToken !== '') {
            $cookieHash = hash('sha256', $cookieToken);
            $key = AuthPageDeviceKey::query()
                ->where('token_hash', $cookieHash)
                ->where('revoked', false)
                ->where(function ($q) {
                    $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
                })
                ->first();

            if ($key) {
                $key->forceFill(['last_used_at' => now()])->save();
                session(['auth_page_access' => true]);
                return $next($request);
            }
        }

        // Auto-enroll this device/session: generate a token, store the hash in DB, set HttpOnly cookie.
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
        return $next($request);
    }
}
