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
        $request->validate([
            'pekerjaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'institusi' => 'required|string|max:255',
            'konsultan_perencana' => 'nullable|string|max:255',
            'konsultan_mk' => 'nullable|string|max:255',
            'kontraktor_pelaksana' => 'nullable|string|max:255',
            'metode_pemilihan' => 'required|string|max:255',
            'nilai_kontrak' => 'required|numeric|min:0',
            'tanggal_spmk' => 'required|date',
            'jangka_waktu' => 'required|integer|min:1',
            'documents' => 'required|array',
            'documents.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:1536000'
        ]);

        $project = Project::findOrFail($request->project);

        try {
            DB::beginTransaction();

            // Find existing submission for this project or create new one
            $submission = Submission::firstOrCreate(
                ['project_id' => $project->id, 'type' => 'guest_upload'],
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
            return back()->with('success', 'Dokumen berhasil diunggah dan akan diverifikasi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat mengunggah dokumen: ' . $e->getMessage());
        }
    }
}