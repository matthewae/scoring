<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\DocumentType;

class ProjectObserver
{
    public function created(Project $project): void
    {
        $documentTypes = DocumentType::all();
        
        // Define categories and their required status based on the government checklist
        $requiredCategories = [
            'Dokumen DED Perencana' => true,
            'Notulensi dan Review' => true,
            'Tender Konsultan MK' => true,
            'Personil Pengawas MK' => true,
            'Personil Pendukung MK' => true,
            'Dokumen Persiapan' => true,
            'Dokumen Perizinan' => true,
            'Pembayaran dan Jaminan' => true
        ];

        foreach ($documentTypes as $documentType) {
            // Check if the category exists in our mapping, default to true if not specified
            $isRequired = $requiredCategories[$documentType->category] ?? true;
            
            $project->documentTypes()->attach($documentType->id, [
                'is_required' => $isRequired,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}