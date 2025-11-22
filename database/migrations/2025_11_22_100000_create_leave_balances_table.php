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
        Schema::create('leave_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->integer('year'); // e.g., 2025
            
            // Single shared paid leave pool (12 days total for casual + medical combined)
            $table->decimal('paid_leave_total', 5, 1)->default(12); // 12 per year (1 per month)
            $table->decimal('paid_leave_used', 5, 1)->default(0);
            $table->decimal('paid_leave_balance', 5, 1)->default(12);
            
            // Track casual and medical separately for reporting (but deduct from same pool)
            $table->decimal('casual_leave_used', 5, 1)->default(0);
            $table->decimal('medical_leave_used', 5, 1)->default(0);
            
            // Personal leave (unpaid, unlimited)
            $table->decimal('personal_leave_used', 5, 1)->default(0);
            
            $table->timestamps();
            
            // Unique constraint: one record per employee per year
            $table->unique(['employee_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_balances');
    }
};
