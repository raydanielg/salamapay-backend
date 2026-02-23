<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthPageKey
{
    public function handle(Request $request, Closure $next)
    {
        $expected = env('AUTH_PAGE_KEY');

        if (!is_string($expected) || $expected === '') {
            return $next($request);
        }

        if ($request->session()->get('auth_page_key_verified') === true) {
            return $next($request);
        }

        $provided = $request->query('key');

        if (!is_string($provided) || !hash_equals($expected, $provided)) {
            abort(403);
        }

        $request->session()->put('auth_page_key_verified', true);

        if ($request->query->has('key')) {
            $cleanQuery = $request->query();
            unset($cleanQuery['key']);

            return redirect()->to($request->path() . (empty($cleanQuery) ? '' : ('?' . http_build_query($cleanQuery))));
        }

        return $next($request);
    }
}
