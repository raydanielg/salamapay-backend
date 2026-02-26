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
        Schema::dropIfExists('escrows');
        Schema::create('escrows', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference_number')->unique();
            $table->foreignUuid('buyer_id')->constrained('users');
            $table->foreignUuid('seller_id')->constrained('users');
            $table->decimal('amount', 20, 2);
            $table->string('status')->default('created'); // created, funded, disputed, released, refunded
            $table->string('release_code')->nullable();
            $table->timestamp('expires_at')->nullable();
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
