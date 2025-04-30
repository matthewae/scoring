<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\ProjectDetail;
use App\Models\DocumentType;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestSubmissionController extends Controller
{
    public function create()
    {
        $documentTypes = DocumentType::all()->groupBy(function($type) {
            if (str_contains($type->code, ['ded_perencana', 'notulensi_koordinasi', 'review_ded'])) {
                return 'Pre-tender Documents';
            } elseif (str_contains($type->code, ['tender_mk', 'review_anggaran', 'ded_tender', 'penilaian_penyedia', 'cek_supplier', 'reviu_spesifikasi'])) {
                return 'Tender Documents';
            }
            return 'Other Documents';
        });

        $projects = Project::where('is_active', true)->get();

        return view('guest.upload', compact('documentTypes', 'projects'));
    }

    public function store(Request $request)
    {
        // Check if user is authenticated and is a guest
        if (!auth()->check() || !auth()->user()->isGuest()) {
            return back()->with('error', 'Unauthorized access. Please login as a guest user.');
        }

        $request->validate([
            'documents' => 'required|array',
            'documents.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:1536000'
        ], [
            'documents.required' => 'Please select at least one document to upload.',
            'documents.array' => 'Invalid document format.',
            'documents.*.required' => 'Each selected document is required.',
            'documents.*.file' => 'Each upload must be a valid file.',
            'documents.*.mimes' => 'Documents must be in PDF, DOC, DOCX, XLS, or XLSX format.',
            'documents.*.max' => 'Document size must not exceed 1.5GB.'
        ]);

        try {
            DB::beginTransaction();

            // Find existing submission for this project or create new one
            $submission = Submission::firstOrCreate(
                ['project_id' => $request->project, 'type' => 'guest_upload'],
                ['status' => 'pending']
            );

            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $documentTypeId => $file) {
                    // Validate document type exists
                    $documentType = DocumentType::find($documentTypeId);
                    if (!$documentType) {
                        throw new \Exception('Invalid document type provided.');
                    }

                    // Check if a file for this document type already exists
                    $existingFile = $submission->files()
                        ->where('document_type_id', $documentTypeId)
                        ->first();

                    // Delete old file if it exists
                    if ($existingFile) {
                        // Delete the physical file
                        if (file_exists(storage_path('app/' . $existingFile->file_path))) {
                            unlink(storage_path('app/' . $existingFile->file_path));
                        }
                        $existingFile->delete();
                    }

                    // Store the new file
                    $path = $file->store('submissions/' . $submission->id);
                    
                    // Create new submission file with proper document type association
                    $submission->files()->create([
                        'document_type_id' => $documentType->id,
                        'file_path' => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType(),
                        'file_size' => $file->getSize(),
                        'status' => 'pending',
                        'score' => 0,
                        'average_score' => 0
                    ]);
                }
            }

            DB::commit();
            return back()->with('success', 'Documents have been successfully uploaded and will be verified.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            $errorMessage = 'An error occurred while uploading documents.';
            if (app()->environment('local', 'development')) {
                $errorMessage .= ' ' . $e->getMessage();
            }
            
            return back()->with('error', $errorMessage);
        }
    }
}