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
                'pekerjaan' => 'Pembangunan Gedung Komersial',
                'lokasi' => 'Jakarta Pusat',
                'kementerian' => 'Kementerian PUPR',
                'konsultan_perencana' => 'PT Konsultan Arsitektur Prima',
                'konsultan_mk' => 'PT Manajemen Konstruksi Utama',
                'kontraktor_pelaksana' => 'PT Pembangunan Jaya',
                'metode_pemilihan' => 'Tender',
                'nilai_kontrak' => 150000000000.00,
                'tanggal_spmk' => '2024-05-01',
                'jangka_waktu' => 730,
                'is_active' => true,
            ],
            [
                'name' => 'Highway Infrastructure Development',
                'description' => 'Construction and development of highway infrastructure including bridges and tunnels',
                'pekerjaan' => 'Pembangunan Jalan Tol',
                'lokasi' => 'Bandung - Cirebon',
                'kementerian' => 'Kementerian PUPR',
                'konsultan_perencana' => 'PT Perencana Jalan Indonesia',
                'konsultan_mk' => 'PT Supervisi Jalan Raya',
                'kontraktor_pelaksana' => 'PT Waskita Karya',
                'metode_pemilihan' => 'Tender',
                'nilai_kontrak' => 2500000000000.00,
                'tanggal_spmk' => '2024-06-01',
                'jangka_waktu' => 1095,
                'is_active' => true,
            ],
            [
                'name' => 'Residential Complex Project',
                'description' => 'Development of residential apartment complex with amenities and utilities',
                'pekerjaan' => 'Pembangunan Kompleks Apartemen',
                'lokasi' => 'Surabaya',
                'kementerian' => 'Kementerian PUPR',
                'konsultan_perencana' => 'PT Desain Arsitektur Nusantara',
                'konsultan_mk' => 'PT Pengawas Bangunan Jaya',
                'kontraktor_pelaksana' => 'PT Adhi Karya',
                'metode_pemilihan' => 'Tender',
                'nilai_kontrak' => 800000000000.00,
                'tanggal_spmk' => '2024-07-01',
                'jangka_waktu' => 912,
                'is_active' => true,
            ],
            [
                'name' => 'Industrial Facility Construction',
                'description' => 'Construction of manufacturing facility with specialized industrial requirements',
                'pekerjaan' => 'Pembangunan Fasilitas Industri',
                'lokasi' => 'Kawasan Industri Cikarang',
                'kementerian' => 'Kementerian Perindustrian',
                'konsultan_perencana' => 'PT Konsultan Industri Terpadu',
                'konsultan_mk' => 'PT Manajemen Proyek Industri',
                'kontraktor_pelaksana' => 'PT Wijaya Karya',
                'metode_pemilihan' => 'Tender',
                'nilai_kontrak' => 450000000000.00,
                'tanggal_spmk' => '2024-08-01',
                'jangka_waktu' => 548,
                'is_active' => true,
            ],
            [
                'name' => 'Public Infrastructure Renovation',
                'description' => 'Renovation and upgrade of existing public infrastructure facilities',
                'pekerjaan' => 'Renovasi Infrastruktur Publik',
                'lokasi' => 'Medan',
                'kementerian' => 'Kementerian PUPR',
                'konsultan_perencana' => 'PT Renovasi Desain Indonesia',
                'konsultan_mk' => 'PT Pengawas Renovasi Utama',
                'kontraktor_pelaksana' => 'PT Hutama Karya',
                'metode_pemilihan' => 'Tender',
                'nilai_kontrak' => 125000000000.00,
                'tanggal_spmk' => '2024-09-01',
                'jangka_waktu' => 365,
                'is_active' => true,
            ],
        ];

        foreach ($projects as $project) {
            $project['user_id'] = $user->id;
            Project::create($project);
        }
    }
}