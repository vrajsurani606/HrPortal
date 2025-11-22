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
        Schema::table('leave_balances', function (Blueprint $table) {
            // Monthly tracking (1 paid leave per month)
            $table->decimal('january_paid_used', 5, 1)->default(0)->after('paid_leave_balance');
            $table->decimal('february_paid_used', 5, 1)->default(0)->after('january_paid_used');
            $table->decimal('march_paid_used', 5, 1)->default(0)->after('february_paid_used');
            $table->decimal('april_paid_used', 5, 1)->default(0)->after('march_paid_used');
            $table->decimal('may_paid_used', 5, 1)->default(0)->after('april_paid_used');
            $table->decimal('june_paid_used', 5, 1)->default(0)->after('may_paid_used');
            $table->decimal('july_paid_used', 5, 1)->default(0)->after('june_paid_used');
            $table->decimal('august_paid_used', 5, 1)->default(0)->after('july_paid_used');
            $table->decimal('september_paid_used', 5, 1)->default(0)->after('august_paid_used');
            $table->decimal('october_paid_used', 5, 1)->default(0)->after('september_paid_used');
            $table->decimal('november_paid_used', 5, 1)->default(0)->after('october_paid_used');
            $table->decimal('december_paid_used', 5, 1)->default(0)->after('november_paid_used');
            
            // Quarterly rollover tracking
            $table->decimal('q1_rollover', 5, 1)->default(0)->after('december_paid_used');
            $table->decimal('q2_rollover', 5, 1)->default(0)->after('q1_rollover');
            $table->decimal('q3_rollover', 5, 1)->default(0)->after('q2_rollover');
            $table->decimal('q4_rollover', 5, 1)->default(0)->after('q3_rollover');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leave_balances', function (Blueprint $table) {
            $table->dropColumn([
                'january_paid_used', 'february_paid_used', 'march_paid_used',
                'april_paid_used', 'may_paid_used', 'june_paid_used',
                'july_paid_used', 'august_paid_used', 'september_paid_used',
                'october_paid_used', 'november_paid_used', 'december_paid_used',
                'q1_rollover', 'q2_rollover', 'q3_rollover', 'q4_rollover'
            ]);
        });
    }
};
