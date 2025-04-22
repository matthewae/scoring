<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SubmissionFile extends Model
{
    protected $fillable = [
        'submission_id',
        'document_type_id',
        'original_name',
        'file_path',
        'mime_type',
        'file_size',
        'uploaded_by_guest',
        'memo',
        'approval_status',
        'approval_memo'
    ];

    protected $casts = [
        'uploaded_by_guest' => 'boolean',
        'file_size' => 'integer'
    ];

    public function approve(string $memo = null): void
    {
        $this->update([
            'approval_status' => 'approved',
            'approval_memo' => $memo
        ]);

        $this->updateSubmissionStatus();
    }

    public function reject(string $memo): void
    {
        $this->update([
            'approval_status' => 'rejected',
            'approval_memo' => $memo
        ]);

        $this->updateSubmissionStatus();
    }

    public function isPending(): bool
    {
        return $this->approval_status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->approval_status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->approval_status === 'rejected';
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function documentScore(): HasOne
    {
        return $this->hasOne(DocumentScore::class);
    }

    public static function createFromUploadedFile(Submission $submission, UploadedFile $file, ?DocumentType $documentType = null, ?string $memo = null): self
    {
        $path = $file->store('submissions');

        return static::create([
            'submission_id' => $submission->id,
            'document_type_id' => $documentType?->id,
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'memo' => $memo,
        ]);
    }

    public function getDownloadUrl(): string
    {
        return Storage::url($this->file_path);
    }

    protected function updateSubmissionStatus(): void
    {
        $submission = $this->submission;
        $allFiles = $submission->files;
        
        if ($allFiles->contains(fn($file) => $file->isRejected())) {
            $submission->update(['status' => 'rejected']);
        } elseif ($allFiles->every(fn($file) => $file->isApproved())) {
            $submission->update(['status' => 'approved']);
        } else {
            $submission->update(['status' => 'pending']);
        }
    }

    public function delete(): bool
    {
        Storage::delete($this->file_path);
        return parent::delete();
    }
}