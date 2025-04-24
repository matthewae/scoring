<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'is_active',
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
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'nilai_kontrak' => 'decimal:2',
        'tanggal_spmk' => 'date',
        'jangka_waktu' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function documentTypes(): BelongsToMany
    {
        return $this->belongsToMany(DocumentType::class, 'project_document_types')
            ->withPivot('is_required')
            ->withTimestamps();
    }
}