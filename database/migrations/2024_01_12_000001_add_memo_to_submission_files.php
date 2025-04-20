<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('submission_files', function (Blueprint $table) {
            $table->text('memo')->nullable()->after('file_size');
        });
    }

    public function down(): void
    {
        Schema::table('submission_files', function (Blueprint $table) {
            $table->dropColumn('memo');
        });
    }
};