<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentScore extends Model
{
    protected $fillable = [
        'submission_file_id',
        'document_type_id',
        'score',
        'feedback'
    ];

    protected $casts = [
        'score' => 'integer'
    ];

    public function submissionFile(): BelongsTo
    {
        return $this->belongsTo(SubmissionFile::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public static function createScore(
        SubmissionFile $file,
        int $score,
        ?string $feedback = null
    ): self {
        return static::create([
            'submission_file_id' => $file->id,
            'document_type_id' => $file->document_type_id,
            'score' => $score,
            'feedback' => $feedback
        ]);
    }
}