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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('provider_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('budget', 10, 2);
            $table->decimal('escrow_amount', 10, 2)->default(0);
            $table->string('category');
            $table->json('attachments')->nullable();
            $table->enum('status', [
                'pending',
                'proposals',
                'in_progress',
                'review',
                'completed',
                'disputed',
                'cancelled',
                'refunded',
            ])->default('pending');
            $table->date('deadline')->nullable();
            $table->date('started_at')->nullable();
            $table->date('completed_at')->nullable();
            $table->json('milestones')->nullable();
            $table->text('client_requirements')->nullable();
            $table->text('provider_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
