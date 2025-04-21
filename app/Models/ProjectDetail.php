<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectDetail extends Model
{
    protected $fillable = [
        'pekerjaan',
        'lokasi',
        'institusi',
        'konsultan_perencana',
        'konsultan_mk',
        'kontraktor_pelaksana',
        'metode_pemilihan',
        'nilai_kontrak',
        'tanggal_spmk',
        'jangka_waktu',
        'submission_id'
    ];

    protected $casts = [
        'nilai_kontrak' => 'decimal:2',
        'tanggal_spmk' => 'date',
        'jangka_waktu' => 'integer'
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }
}