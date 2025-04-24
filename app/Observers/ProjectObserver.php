<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\DocumentType;

class ProjectObserver
{
    public function created(Project $project): void
    {
        $documentTypes = DocumentType::all();
        
        // Define categories that contain required documents
        $requiredCategories = [
            'Dokumen DED Perencana',
            'Dokumen Persiapan',
            'Dokumen Perizinan',
            'Pembayaran dan Jaminan'
        ];

        foreach ($documentTypes as $documentType) {
            $isRequired = in_array($documentType->category, $requiredCategories);
            
            $project->documentTypes()->attach($documentType->id, [
                'is_required' => $isRequired,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}