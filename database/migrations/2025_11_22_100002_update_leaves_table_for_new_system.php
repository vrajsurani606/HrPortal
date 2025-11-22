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
        Schema::table('leaves', function (Blueprint $table) {
            // Add is_paid column
            $table->boolean('is_paid')->default(true)->after('leave_type');
            
            // Add half_day support
            $table->boolean('is_half_day')->default(false)->after('total_days');
            
            // Add rejected_by and rejected_at
            $table->foreignId('rejected_by')->nullable()->after('approved_at')->constrained('users')->onDelete('set null');
            $table->timestamp('rejected_at')->nullable()->after('rejected_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leaves', function (Blueprint $table) {
            $table->dropForeign(['rejected_by']);
            $table->dropColumn(['is_paid', 'is_half_day', 'rejected_by', 'rejected_at']);
        });
    }
};
