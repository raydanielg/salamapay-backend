<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureAuthPageMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $configKey = config('tyro-login.page_key', 'change-me-please');

        // Ikiwa kuna key kwenye URL, iweke kwenye session na redirect ili kuifuta kwenye URL
        if ($request->has('key') && $request->query('key') === $configKey) {
            session(['auth_page_access' => true]);
            return redirect($request->fullUrlWithQuery(['key' => null]));
        }

        // Ruhusu kama session ipo au kama ombi si la GET (mfano login POST)
        if (session('auth_page_access') === true || !$request->isMethod('get')) {
            return $next($request);
        }

        // Ikiwa haina access, toa 403 Forbidden
        abort(403, 'Unauthorized access to authentication pages.');
    }
}
