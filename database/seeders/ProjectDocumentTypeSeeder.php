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

        foreach ($projects as $project) {
            // Associate all document types with the project
            foreach ($documentTypes as $documentType) {
                $project->documentTypes()->attach($documentType->id, [
                    'is_required' => true, // You can customize this based on your requirements
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}