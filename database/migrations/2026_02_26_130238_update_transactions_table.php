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
        Schema::dropIfExists('transactions');
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference_number')->unique();
            $table->string('type'); // deposit, escrow_create, escrow_release, withdrawal, payout
            $table->foreignUuid('from_user_id')->nullable()->constrained('users');
            $table->foreignUuid('to_user_id')->nullable()->constrained('users');
            $table->decimal('amount', 20, 2);
            $table->string('currency')->default('TZS');
            $table->string('provider_reference')->nullable();
            $table->string('status')->default('initiated'); // initiated, pending, completed, failed, reversed
            $table->integer('risk_score')->default(0);
            $table->string('ip_address')->nullable();
            $table->string('device_hash')->nullable();
            $table->json('metadata')->nullable();
            $table->string('signature')->nullable(); // Signed transaction for security
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
