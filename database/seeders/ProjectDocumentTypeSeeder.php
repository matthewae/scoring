<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class ProjectDocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        $documentTypes = DocumentType::all();

        // Define categories that contain required documents
        $requiredCategories = [
            'Dokumen DED Perencana',
            'Dokumen Persiapan',
            'Dokumen Perizinan',
            'Pembayaran dan Jaminan'
        ];

        foreach ($projects as $project) {
            foreach ($documentTypes as $documentType) {
                $isRequired = in_array($documentType->category, $requiredCategories);
                
                $project->documentTypes()->syncWithoutDetaching([
                    $documentType->id => [
                        'is_required' => $isRequired,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                ]);
            }
        }
    }
}