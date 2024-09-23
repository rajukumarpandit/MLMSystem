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
        Schema::create('referral__rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // User who earned
            $table->foreignId('referrer_id')->nullable()->constrained('users'); // Referrer who caused the earning
            $table->decimal('amount', 10, 2); // Reward amount
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral__rewards');
    }
};
