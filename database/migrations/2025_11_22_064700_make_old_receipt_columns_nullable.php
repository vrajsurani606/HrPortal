<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Get all columns in receipts table
        $columns = DB::select("SHOW COLUMNS FROM receipts");
        
        Schema::table('receipts', function (Blueprint $table) use ($columns) {
            foreach ($columns as $column) {
                $columnName = $column->Field;
                
                // Skip our new columns and system columns
                if (in_array($columnName, ['id', 'created_at', 'updated_at', 'unique_code', 'receipt_date', 'company_name', 'invoice_ids', 'received_amount', 'payment_type', 'narration', 'trans_code'])) {
                    continue;
                }
                
                // Make old columns nullable
                if ($column->Null === 'NO') {
                    // Determine column type and make nullable
                    if (strpos($column->Type, 'decimal') !== false) {
                        $table->decimal($columnName, 10, 2)->nullable()->change();
                    } elseif (strpos($column->Type, 'int') !== false) {
                        $table->integer($columnName)->nullable()->change();
                    } elseif (strpos($column->Type, 'date') !== false) {
                        $table->date($columnName)->nullable()->change();
                    } elseif (strpos($column->Type, 'text') !== false) {
                        $table->text($columnName)->nullable()->change();
                    } else {
                        $table->string($columnName)->nullable()->change();
                    }
                }
            }
        });
    }

    public function down(): void
    {
        // Cannot reliably reverse this
    }
};
