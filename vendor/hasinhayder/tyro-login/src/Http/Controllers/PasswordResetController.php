<?php

namespace HasinHayder\TyroLogin\Http\Controllers;

use HasinHayder\TyroLogin\Mail\PasswordResetMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class PasswordResetController extends Controller {
    /**
     * Show the forgot password form.
     */
    public function showForgotPasswordForm(): View {
        return view('tyro-login::forgot-password', [
            'layout' => config('tyro-login.layout', 'centered'),
            'branding' => config('tyro-login.branding'),
            'backgroundImage' => config('tyro-login.background_image'),
            'loginField' => config('tyro-login.login_field', 'email'),
            'pageContent' => config('tyro-login.pages.forgot_password', [
                        'title' => 'Forgot Password?',
                        'subtitle' => 'Enter your email and we\'ll send you a reset link.',
                    ]),
        ]);
    }

    /**
     * Send password reset link (Updated to send OTP via Phone).
     */
    public function sendResetLink(Request $request): RedirectResponse {
        $request->validate([
            'phone' => ['required', 'string'],
        ]);

        $userModel = config('tyro-login.user_model', 'App\\Models\\User');
        $user = $userModel::where('phone', $request->phone)->first();

        if (!$user) {
            // Don't reveal that user doesn't exist for security
            return redirect()->route('tyro-login.password.request')
                ->with('success', 'If an account with that phone number exists, we\'ve sent a verification code.');
        }

        // Generate OTP for password reset
        $otp = rand(100000, 999999);
        $user->update([
            'phone_otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // In production, send via SMS gateway here
        // Store user ID in session for verification
        $request->session()->put('tyro-login.password_reset.user_id', $user->id);

        return redirect()->route('tyro-login.password.reset.otp');
    }

    /**
     * Show the password reset OTP verification form.
     */
    public function showResetOtpForm(Request $request): View|RedirectResponse {
        $userId = $request->session()->get('tyro-login.password_reset.user_id');
        if (!$userId) {
            return redirect()->route('tyro-login.password.request');
        }

        return view('tyro-login::reset-password-otp', [
            'layout' => config('tyro-login.layout', 'centered'),
            'branding' => config('tyro-login.branding'),
            'backgroundImage' => config('tyro-login.background_image'),
            'pageContent' => config('tyro-login.pages.forgot_password'),
        ]);
    }

    /**
     * Verify OTP and reset the password.
     */
    public function verifyOtpAndReset(Request $request): RedirectResponse {
        $userId = $request->session()->get('tyro-login.password_reset.user_id');
        $userModel = config('tyro-login.user_model', 'App\\Models\\User');
        $user = $userModel::findOrFail($userId);

        $minLength = config('tyro-login.password.min_length', 8);

        $request->validate([
            'phone_otp' => ['required', 'string', 'size:6'],
            'password' => ['required', 'string', Password::min($minLength)],
        ]);

        if ($user->phone_otp !== $request->phone_otp) {
            throw ValidationException::withMessages([
                'phone_otp' => 'The provided OTP is incorrect.',
            ]);
        }

        if (now()->gt($user->otp_expires_at)) {
            throw ValidationException::withMessages([
                'phone_otp' => 'The OTP has expired. Please request a new one.',
            ]);
        }

        // Update the password
        $user->password = Hash::make($request->password);
        $user->phone_otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Clear session
        $request->session()->forget('tyro-login.password_reset.user_id');

        // Log the user in
        Auth::login($user);

        return redirect(config('tyro-login.redirects.after_login', '/'))
            ->with('success', 'Your password has been reset successfully.');
    }

    /**
     * Generate a password reset URL for the user.
     */
    public function generateResetUrl($user): string {
        $token = Str::random(64);
        $expiresAt = now()->addMinutes(config('tyro-login.password_reset.expire', 60));

        // Store token in cache
        Cache::put(
            "tyro-login:password-reset:{$token}",
            [
                'user_id' => $user->id,
                'email' => $user->email,
            ],
            $expiresAt
        );

        $url = URL::temporarySignedRoute(
            'tyro-login.password.reset',
            $expiresAt,
            ['token' => $token]
        );

        // Log the reset URL for development (only if debug is enabled)
        if (config('tyro-login.debug', false)) {
            Log::info('Tyro Login - Password Reset Link Generated', [
                'user_id' => $user->id,
                'email' => Str::mask($user->email, '*', 3),
                'expires_in_minutes' => config('tyro-login.password_reset.expire', 60),
            ]);
        }

        return $url;
    }

    /**
     * Show the password reset form.
     */
    public function showResetForm(Request $request, string $token): View|RedirectResponse {
        // Validate signature
        if (!$request->hasValidSignature()) {
            return redirect()->route('tyro-login.password.request')
                ->with('error', 'The password reset link is invalid or has expired.');
        }

        // Get user data from cache
        $data = Cache::get("tyro-login:password-reset:{$token}");

        if (!$data) {
            return redirect()->route('tyro-login.password.request')
                ->with('error', 'The password reset link is invalid or has expired.');
        }

        return view('tyro-login::reset-password', [
            'layout' => config('tyro-login.layout', 'centered'),
            'branding' => config('tyro-login.branding'),
            'backgroundImage' => config('tyro-login.background_image'),
            'token' => $token,
            'email' => $data['email'],
            'pageContent' => config('tyro-login.pages.reset_password', [
                        'title' => 'Reset Password',
                        'subtitle' => 'Enter your new password below.',
                    ]),
        ]);
    }

    /**
     * Reset the password.
     */
    public function reset(Request $request): RedirectResponse {
        $minLength = config('tyro-login.password.min_length', 8);

        $request->validate([
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', Password::min($minLength)],
        ]);

        $token = $request->token;

        // Get user data from cache
        $data = Cache::get("tyro-login:password-reset:{$token}");

        if (!$data) {
            return redirect()->route('tyro-login.password.request')
                ->with('error', 'The password reset link is invalid or has expired.');
        }

        $userModel = config('tyro-login.user_model', 'App\\Models\\User');
        $user = $userModel::find($data['user_id']);

        if (!$user) {
            return redirect()->route('tyro-login.password.request')
                ->with('error', 'User not found.');
        }

        // Update the password
        $user->password = Hash::make($request->password);
        $user->save();

        // Clear the reset token
        Cache::forget("tyro-login:password-reset:{$token}");

        // Log the user in
        Auth::login($user);

        return redirect(config('tyro-login.redirects.after_login', '/'))
            ->with('success', 'Your password has been reset successfully.');
    }
}
