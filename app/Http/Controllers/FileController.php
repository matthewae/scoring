<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\Submission;
use App\Models\SubmissionFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function upload(Request $request, ?Submission $submission = null)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:10240', // Max 10MB
            'document_type_id' => 'required|exists:document_types,id',
            'memo' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $documentType = DocumentType::findOrFail($request->document_type_id);
        $isGuestUpload = !auth()->check();

        // If no submission provided and it's a guest upload, create a new submission
        if (!$submission && $isGuestUpload) {
            $submission = Submission::create([
                'status' => 'pending',
                'user_id' => null
            ]);
        }

        // Store the file
        $path = $file->store('submissions/' . $submission->id);
        
        $submissionFile = SubmissionFile::create([
            'submission_id' => $submission->id,
            'document_type_id' => $documentType->id,
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'uploaded_by_guest' => $isGuestUpload,
            'memo' => $request->memo
        ]);

        return response()->json([
            'message' => 'File uploaded successfully',
            'file' => $submissionFile
        ]);
    }

    public function download(SubmissionFile $file): StreamedResponse
    {
        // Check if user is authorized to download
        if (!auth()->check() && !$file->uploaded_by_guest) {
            abort(403, 'Unauthorized access');
        }

        if (!Storage::exists($file->file_path)) {
            abort(404, 'File not found');
        }

        return Storage::download(
            $file->file_path,
            $file->original_name,
            ['Content-Type' => $file->mime_type]
        );
    }
}