<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            if (!Schema::hasColumn('tickets', 'ticket_no')) {
                $table->string('ticket_no')->unique()->after('id');
            }
            if (!Schema::hasColumn('tickets', 'subject')) {
                $table->string('subject')->nullable()->after('ticket_no');
            }
            if (!Schema::hasColumn('tickets', 'status')) {
                $table->enum('status', ['open','in_progress','resolved','closed'])->default('open')->after('subject');
            }
            if (!Schema::hasColumn('tickets', 'priority')) {
                $table->enum('priority', ['low','medium','high','urgent'])->default('medium')->after('status');
            }
            if (!Schema::hasColumn('tickets', 'assigned_to')) {
                $table->string('assigned_to')->nullable()->after('priority');
            }
            if (!Schema::hasColumn('tickets', 'opened_by')) {
                $table->string('opened_by')->nullable()->after('assigned_to');
            }
            if (!Schema::hasColumn('tickets', 'opened_at')) {
                $table->timestamp('opened_at')->nullable()->after('opened_by');
            }
            if (!Schema::hasColumn('tickets', 'work_status')) {
                $table->enum('work_status', ['completed','not_assigned','in_progress','on_hold'])->default('not_assigned')->after('opened_at');
            }
            if (!Schema::hasColumn('tickets', 'category')) {
                $table->string('category')->nullable()->after('work_status');
            }
            if (!Schema::hasColumn('tickets', 'customer')) {
                $table->string('customer')->nullable()->after('category');
            }
            if (!Schema::hasColumn('tickets', 'title')) {
                $table->string('title')->nullable()->after('customer');
            }
            if (!Schema::hasColumn('tickets', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (!Schema::hasColumn('tickets', 'company')) {
                $table->string('company')->nullable()->after('description');
            }
            if (!Schema::hasColumn('tickets', 'ticket_type')) {
                $table->string('ticket_type')->nullable()->after('company');
            }
            if (!Schema::hasColumn('tickets', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // No destructive down to avoid data loss
        });
    }
};
