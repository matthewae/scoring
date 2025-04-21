<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->string('pekerjaan');
            $table->string('lokasi');
            $table->string('institusi');
            $table->string('konsultan_perencana')->nullable();
            $table->string('konsultan_mk')->nullable();
            $table->string('kontraktor_pelaksana')->nullable();
            $table->string('metode_pemilihan');
            $table->decimal('nilai_kontrak', 15, 2);
            $table->date('tanggal_spmk');
            $table->integer('jangka_waktu');
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_details');
    }
};