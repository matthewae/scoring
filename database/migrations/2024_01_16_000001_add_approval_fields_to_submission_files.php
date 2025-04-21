<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('submission_files', function (Blueprint $table) {
            $table->string('approval_status')->default('pending')->after('memo');
            $table->text('approval_memo')->nullable()->after('approval_status');
        });
    }

    public function down(): void
    {
        Schema::table('submission_files', function (Blueprint $table) {
            $table->dropColumn(['approval_status', 'approval_memo']);
        });
    }
};