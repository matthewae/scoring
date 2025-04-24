<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => 'password',
                'email_verified_at' => now(),
                'status' => 'user'
            ]
        );
        $projects = [
            [
                'name' => 'Commercial Building Construction',
                'description' => 'Construction of a multi-story commercial building including structural, electrical, and plumbing work',
                'is_active' => true,
            ],
            [
                'name' => 'Highway Infrastructure Development',
                'description' => 'Construction and development of highway infrastructure including bridges and tunnels',
                'is_active' => true,
            ],
            [
                'name' => 'Residential Complex Project',
                'description' => 'Development of residential apartment complex with amenities and utilities',
                'is_active' => true,
            ],
            [
                'name' => 'Industrial Facility Construction',
                'description' => 'Construction of manufacturing facility with specialized industrial requirements',
                'is_active' => true,
            ],
            [
                'name' => 'Public Infrastructure Renovation',
                'description' => 'Renovation and upgrade of existing public infrastructure facilities',
                'is_active' => true,
            ],
        ];

        foreach ($projects as $project) {
            $project['user_id'] = $user->id;
            Project::create($project);
        }
    }
}