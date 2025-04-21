<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'required',
        'category'
    ];

    protected $casts = [
        'required' => 'boolean'
    ];

    public function submissionFiles(): HasMany
    {
        return $this->hasMany(SubmissionFile::class);
    }

    public function documentScores(): HasMany
    {
        return $this->hasMany(DocumentScore::class);
    }

    public static function findByCode(string $code): ?self
    {
        return static::where('code', $code)->first();
    }
}