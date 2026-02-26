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

// Redirect default auth routes to tyro-login routes
Route::get('/login', function () {
    return redirect()->route('tyro-login.login');
});

Route::get('/register', function () {
    return redirect()->route('tyro-login.register');
});

Route::get('/terms', function () {
    return view('legal.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('legal.privacy');
})->name('privacy');

Route::group([
    'prefix' => config('tyro-dashboard.routes.prefix', 'dashboard'),
    'middleware' => config('tyro-dashboard.routes.middleware', ['web', 'auth']),
    'as' => config('tyro-dashboard.routes.name_prefix', 'tyro-dashboard.'),
], function () {
    Route::post('/mode/user', function () {
        $user = auth()->user();
        $isAdmin = false;
        if ($user) {
            $adminRoles = config('tyro-dashboard.admin_roles', ['admin', 'super-admin']);
            if (method_exists($user, 'tyroRoleSlugs')) {
                $userRoles = $user->tyroRoleSlugs();
                foreach ($adminRoles as $role) {
                    if (in_array($role, $userRoles)) {
                        $isAdmin = true;
                        break;
                    }
                }
            }

            if (!$isAdmin && method_exists($user, 'isAdmin')) {
                $isAdmin = (bool) $user->isAdmin();
            }
        }
        if (!$isAdmin) {
            abort(403);
        }

        session(['tyro_dashboard_view_mode' => 'user']);
        return redirect()->back();
    })->name('mode.user');

    Route::post('/mode/admin', function () {
        $user = auth()->user();
        $isAdmin = false;
        if ($user) {
            $adminRoles = config('tyro-dashboard.admin_roles', ['admin', 'super-admin']);
            if (method_exists($user, 'tyroRoleSlugs')) {
                $userRoles = $user->tyroRoleSlugs();
                foreach ($adminRoles as $role) {
                    if (in_array($role, $userRoles)) {
                        $isAdmin = true;
                        break;
                    }
                }
            }

            if (!$isAdmin && method_exists($user, 'isAdmin')) {
                $isAdmin = (bool) $user->isAdmin();
            }
        }
        if (!$isAdmin) {
            abort(403);
        }

        session()->forget('tyro_dashboard_view_mode');
        return redirect()->back();
    })->name('mode.admin');

    Route::get('/transactions', function () {
        return view('tyro-dashboard::transactions.index');
    })->name('transactions');

    Route::get('/payments/create', function () {
        return view('tyro-dashboard::payments.create');
    })->name('payments.create');

    Route::get('/withdrawals/approved', function () {
        return view('tyro-dashboard::withdrawals.approved');
    })->name('withdrawals.approved');

    Route::get('/withdrawals/pending', function () {
        return view('tyro-dashboard::withdrawals.pending');
    })->name('withdrawals.pending');

    Route::get('/withdrawals/requested', function () {
        return view('tyro-dashboard::withdrawals.requested');
    })->name('withdrawals.requested');

    Route::get('/payouts/history', function () {
        return view('tyro-dashboard::payouts.history');
    })->name('payouts.history');

    Route::get('/payouts/credentials', function () {
        return view('tyro-dashboard::payouts.credentials');
    })->name('payouts.credentials');

    Route::get('/settings/2fa', function () {
        return view('tyro-dashboard::settings.2fa');
    })->name('settings.2fa');

    Route::get('/business', function () {
        return view('tyro-dashboard::business.index');
    })->name('business');

    Route::get('/support', function () {
        return view('tyro-dashboard::support.index');
    })->name('support');

    Route::get('/developer/api-keys', function () {
        return view('tyro-dashboard::developer.api-keys');
    })->name('developer.api-keys');

    Route::get('/developer/api-configuration', function () {
        return view('tyro-dashboard::developer.api-configuration');
    })->name('developer.api-configuration');

    Route::get('/developer/webhooks', function () {
        return view('tyro-dashboard::developer.webhooks');
    })->name('developer.webhooks');

    // Admin System Settings
    Route::get('/admin/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('/admin/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('admin.settings.update');
    Route::post('/admin/settings/test-mail', [\App\Http\Controllers\Admin\SettingsController::class, 'testMail'])->name('admin.settings.test-mail');
});
