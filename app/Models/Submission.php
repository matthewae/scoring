<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'score',
        'feedback',
    ];

    protected $casts = [
        'score' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(SubmissionFile::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isScored(): bool
    {
        return !is_null($this->score);
    }

    public function score(int $score, string $feedback = null): void
    {
        $this->update([
            'score' => $score,
            'feedback' => $feedback,
            'status' => 'scored',
        ]);
    }
}