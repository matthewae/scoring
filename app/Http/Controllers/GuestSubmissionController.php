<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\ProjectDetail;
use App\Models\DocumentType;
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

        return view('guest.upload', compact('documentTypes'));
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
            'documents.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240'
        ]);

        try {
            DB::beginTransaction();

            $submission = Submission::create([
                'type' => 'guest_upload',
                'status' => 'pending'
            ]);

            $projectDetail = ProjectDetail::create(array_merge(
                $request->only([
                    'pekerjaan', 'lokasi', 'institusi', 'konsultan_perencana',
                    'konsultan_mk', 'kontraktor_pelaksana', 'metode_pemilihan',
                    'nilai_kontrak', 'tanggal_spmk', 'jangka_waktu'
                ]),
                ['submission_id' => $submission->id]
            ));

            foreach ($request->file('documents') as $documentTypeId => $file) {
                $path = $file->store('submissions/' . $submission->id);
                $submission->files()->create([
                    'document_type_id' => $documentTypeId,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName()
                ]);
            }

            DB::commit();
            return redirect()->route('home')->with('success', 'Dokumen berhasil diunggah dan akan diverifikasi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat mengunggah dokumen. Silakan coba lagi.');
        }
    }
}