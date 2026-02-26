<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_otp')->nullable()->after('remember_token');
            $table->string('phone_otp')->nullable()->after('email_otp');
            $table->timestamp('otp_expires_at')->nullable()->after('phone_otp');
            $table->timestamp('phone_verified_at')->nullable()->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['email_otp', 'phone_otp', 'otp_expires_at', 'phone_verified_at']);
        });
    }
};
