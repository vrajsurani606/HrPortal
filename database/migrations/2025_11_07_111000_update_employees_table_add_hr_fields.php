<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('code')->unique()->nullable()->after('id');
            $table->string('mobile_no', 20)->nullable()->after('email');
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->string('password_hash')->nullable();
            $table->string('reference_name')->nullable();
            $table->string('reference_no', 20)->nullable();
            $table->string('aadhaar_no', 20)->nullable();
            $table->string('pan_no', 20)->nullable();
            $table->string('aadhaar_photo_front')->nullable();
            $table->string('aadhaar_photo_back')->nullable();
            $table->string('pan_photo')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_no', 30)->nullable();
            $table->string('bank_ifsc', 20)->nullable();
            $table->string('cheque_photo')->nullable();
            $table->string('marksheet_photo')->nullable();
            $table->string('experience_type')->nullable();
            $table->string('previous_company_name')->nullable();
            $table->decimal('previous_salary', 12, 2)->nullable();
            $table->decimal('current_offer_amount', 12, 2)->nullable();
            $table->boolean('has_incentive')->default(false);
            $table->decimal('incentive_amount', 12, 2)->nullable();
            $table->date('joining_date')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->enum('status', ['active','inactive','on_hold'])->default('active');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'code','mobile_no','address','position','password_hash','reference_name','reference_no','aadhaar_no','pan_no','aadhaar_photo_front','aadhaar_photo_back','pan_photo','bank_name','bank_account_no','bank_ifsc','cheque_photo','marksheet_photo','experience_type','previous_company_name','previous_salary','current_offer_amount','has_incentive','incentive_amount','joining_date','role_id','status'
            ]);
        });
    }
};
