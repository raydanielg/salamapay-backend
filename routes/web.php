<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (session()->get('auth_page_key_verified') === true) {
        return redirect('/auth/login');
    }

    $key = env('AUTH_PAGE_KEY');
    $url = '/auth/login';

    if (is_string($key) && $key !== '') {
        $url .= '?key=' . urlencode($key);
    }

    return redirect($url);
});
