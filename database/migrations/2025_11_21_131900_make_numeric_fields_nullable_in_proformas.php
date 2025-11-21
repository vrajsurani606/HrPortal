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
        Schema::table('proformas', function (Blueprint $table) {
            $table->decimal('discount_percent', 10, 2)->nullable()->default(0)->change();
            $table->decimal('retention_percent', 10, 2)->nullable()->default(0)->change();
            $table->decimal('cgst_percent', 10, 2)->nullable()->default(0)->change();
            $table->decimal('sgst_percent', 10, 2)->nullable()->default(0)->change();
            $table->decimal('igst_percent', 10, 2)->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proformas', function (Blueprint $table) {
            $table->decimal('discount_percent', 10, 2)->nullable(false)->change();
            $table->decimal('retention_percent', 10, 2)->nullable(false)->change();
            $table->decimal('cgst_percent', 10, 2)->nullable(false)->change();
            $table->decimal('sgst_percent', 10, 2)->nullable(false)->change();
            $table->decimal('igst_percent', 10, 2)->nullable(false)->change();
        });
    }
};
