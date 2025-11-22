<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('receipts', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('receipts', 'unique_code')) {
                $table->string('unique_code')->unique()->after('id');
            }
            if (!Schema::hasColumn('receipts', 'receipt_date')) {
                $table->date('receipt_date')->after('unique_code');
            }
            if (!Schema::hasColumn('receipts', 'company_name')) {
                $table->string('company_name')->after('receipt_date');
            }
            if (!Schema::hasColumn('receipts', 'invoice_ids')) {
                $table->json('invoice_ids')->nullable()->after('company_name');
            }
            if (!Schema::hasColumn('receipts', 'received_amount')) {
                $table->decimal('received_amount', 10, 2)->after('invoice_ids');
            }
            if (!Schema::hasColumn('receipts', 'payment_type')) {
                $table->string('payment_type')->nullable()->after('received_amount');
            }
            if (!Schema::hasColumn('receipts', 'narration')) {
                $table->text('narration')->nullable()->after('payment_type');
            }
            if (!Schema::hasColumn('receipts', 'trans_code')) {
                $table->string('trans_code')->nullable()->after('narration');
            }
        });
    }

    public function down(): void
    {
        Schema::table('receipts', function (Blueprint $table) {
            $columns = ['unique_code', 'receipt_date', 'company_name', 'invoice_ids', 'received_amount', 'payment_type', 'narration', 'trans_code'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('receipts', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
