<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->boolean('required')->default(true);
            $table->timestamps();
        });

        Schema::create('document_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_file_id')->constrained()->onDelete('cascade');
            $table->foreignId('document_type_id')->constrained()->onDelete('cascade');
            $table->integer('score')->default(0);
            $table->text('feedback')->nullable();
            $table->timestamps();
        });

        Schema::table('submission_files', function (Blueprint $table) {
            $table->foreignId('document_type_id')->nullable()->constrained()->after('submission_id');
        });
    }

    public function down(): void
    {
        Schema::table('submission_files', function (Blueprint $table) {
            $table->dropForeign(['document_type_id']);
            $table->dropColumn('document_type_id');
        });

        Schema::dropIfExists('document_scores');
        Schema::dropIfExists('document_types');
    }
};