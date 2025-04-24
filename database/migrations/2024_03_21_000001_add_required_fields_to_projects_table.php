<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('pekerjaan')->after('name');
            $table->string('lokasi')->after('pekerjaan');
            $table->string('kementerian')->after('lokasi');
            $table->string('konsultan_perencana')->after('kementerian');
            $table->string('konsultan_mk')->after('konsultan_perencana');
            $table->string('kontraktor_pelaksana')->after('konsultan_mk');
            $table->string('metode_pemilihan')->after('kontraktor_pelaksana');
            $table->decimal('nilai_kontrak', 15, 2)->after('metode_pemilihan');
            $table->date('tanggal_spmk')->nullable()->after('nilai_kontrak');
            $table->integer('jangka_waktu')->after('tanggal_spmk');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'pekerjaan',
                'lokasi',
                'kementerian',
                'konsultan_perencana',
                'konsultan_mk',
                'kontraktor_pelaksana',
                'metode_pemilihan',
                'nilai_kontrak',
                'tanggal_spmk',
                'jangka_waktu'
            ]);
        });
    }
};