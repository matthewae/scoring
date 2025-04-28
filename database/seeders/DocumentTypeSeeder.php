<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        // Using updateOrCreate to handle duplicate entries gracefully
        $documentTypes = [
            // Dokumen DED Perencana
            ['name' => 'Laporan Pendahuluan Penyusunan Masterplan dan DED', 'code' => 'ded_pendahuluan_mp', 'description' => 'Laporan awal penyusunan masterplan dan DED', 'category' => 'Dokumen DED Perencana'],
            ['name' => 'Laporan Antara Pengembangan Rancangan', 'code' => 'ded_antara_rancangan', 'description' => 'Laporan antara pengembangan rancangan penyusunan masterplan dan DED', 'category' => 'Dokumen DED Perencana'],
            ['name' => 'Laporan Akhir Master Plan', 'code' => 'ded_akhir_mp', 'description' => 'Laporan akhir master plan', 'category' => 'Dokumen DED Perencana'],
            ['name' => 'Laporan Akhir Master Plan dan DED', 'code' => 'ded_akhir_full', 'description' => 'Laporan akhir master plan dan detail engineering design', 'category' => 'Dokumen DED Perencana'],
            ['name' => 'Rencana Kerja dan Syarat-Syarat (RKS)', 'code' => 'ded_rks', 'description' => 'Dokumen rencana kerja dan syarat-syarat', 'category' => 'Dokumen DED Perencana'],
            ['name' => 'Gambar Perencanaan', 'code' => 'ded_gambar', 'description' => 'Gambar-gambar perencanaan', 'category' => 'Dokumen DED Perencana'],
            
            // Notulensi dan Review
            ['name' => 'Notulensi Hasil Rapat Koordinasi', 'code' => 'notulensi_koordinasi', 'description' => 'Notulensi hasil rapat koordinasi proses review penyusunan DED', 'category' => 'Notulensi dan Review'],
            ['name' => 'Kesesuaian Desain dengan Standar', 'code' => 'review_kesesuaian', 'description' => 'Kesesuaian Desain (DED) dengan standar teknis dan kondisi lapangan', 'category' => 'Notulensi dan Review'],
            ['name' => 'Kesesuaian Gambar dengan RKS', 'code' => 'review_gambar', 'description' => 'Kesesuaian Gambar Desain dengan RKS dan RAB', 'category' => 'Notulensi dan Review'],
            ['name' => 'Review Kewajaran Harga', 'code' => 'review_harga', 'description' => 'Review kewajaran harga pada RAB', 'category' => 'Notulensi dan Review'],
            ['name' => 'Kesesuaian Waktu Pelaksanaan', 'code' => 'review_waktu', 'description' => 'Kesesuaian rencana waktu pelaksanaan', 'category' => 'Notulensi dan Review'],
            ['name' => 'Hasil Evaluasi Perbaikan', 'code' => 'review_evaluasi', 'description' => 'Hasil evaluasi yang telah diperbaiki atau dilengkapi oleh konsultan perencana', 'category' => 'Notulensi dan Review'],
            ['name' => 'Review SMKK', 'code' => 'review_smkk', 'description' => 'Hasil review dokumen KAK terhadap SMKK', 'category' => 'Notulensi dan Review'],
            ['name' => 'Program Mutu Pengawasan', 'code' => 'review_mutu', 'description' => 'Program mutu pengawasan', 'category' => 'Notulensi dan Review'],
            ['name' => 'Notulensi Aanwijzing', 'code' => 'notulensi_aanwijzing', 'description' => 'Dokumen Notulensi terkait kegiatan aanwijzing', 'category' => 'Notulensi dan Review'],
            
            // Tender Konsultan MK
            ['name' => 'Dokumen KAK Konsultan MK', 'code' => 'mk_kak', 'description' => 'Kerangka Acuan Kerja Konsultan MK', 'category' => 'Tender Konsultan MK'],
            ['name' => 'Dokumen Penawaran Konsultan MK', 'code' => 'mk_penawaran', 'description' => 'Dokumen penawaran dari konsultan MK', 'category' => 'Tender Konsultan MK'],
            ['name' => 'Cek Personil Konsultan MK', 'code' => 'mk_cek_personil', 'description' => 'Dokumen pengecekan personil konsultan MK', 'category' => 'Tender Konsultan MK'],
            ['name' => 'Team Leader', 'code' => 'mk_team_leader', 'description' => 'Dokumen tenaga ahli - Team Leader', 'category' => 'Tender Konsultan MK'],
            ['name' => 'Tenaga Ahli Arsitektur', 'code' => 'mk_ahli_arsitek', 'description' => 'Dokumen tenaga ahli teknik arsitektur', 'category' => 'Tender Konsultan MK'],
            ['name' => 'Tenaga Ahli Struktur/Sipil', 'code' => 'mk_ahli_struktur', 'description' => 'Dokumen tenaga ahli struktur/sipil', 'category' => 'Tender Konsultan MK'],
            ['name' => 'Tenaga Ahli MEP', 'code' => 'mk_ahli_mep', 'description' => 'Dokumen tenaga ahli mekanikal/elektrikal', 'category' => 'Tender Konsultan MK'],
            ['name' => 'Tenaga Ahli K3', 'code' => 'mk_ahli_k3', 'description' => 'Dokumen tenaga ahli K3 konstruksi', 'category' => 'Tender Konsultan MK'],
            
            // Personil Pengawas MK
            ['name' => 'Site Engineer', 'code' => 'mk_site_engineer', 'description' => 'Dokumen Site Engineer', 'category' => 'Personil Pengawas MK'],
            ['name' => 'Pengawas Arsitektur', 'code' => 'mk_pengawas_arsitek', 'description' => 'Dokumen pengawas arsitektur', 'category' => 'Personil Pengawas MK'],
            ['name' => 'Pengawas Struktur', 'code' => 'mk_pengawas_struktur', 'description' => 'Dokumen pengawas struktur', 'category' => 'Personil Pengawas MK'],
            ['name' => 'Pengawas MEP', 'code' => 'mk_pengawas_mep', 'description' => 'Dokumen pengawas MEP', 'category' => 'Personil Pengawas MK'],

            // Personil Pendukung MK
            ['name' => 'Juru Gambar/Drafter BIM', 'code' => 'mk_drafter', 'description' => 'Dokumen juru gambar/drafter BIM', 'category' => 'Personil Pendukung MK'],
            ['name' => 'Administrasi dan Surveyor', 'code' => 'mk_admin_surveyor', 'description' => 'Dokumen administrasi dan surveyor', 'category' => 'Personil Pendukung MK'],

            // Dokumen Persiapan
            ['name' => 'BA Aanwijzing', 'code' => 'ba_aanwijzing', 'description' => 'Berita acara aanwijzing', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Notulen Rapat Persiapan', 'code' => 'notulen_persiapan', 'description' => 'Notulen rapat persiapan pelaksanaan kontrak', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Kontrak Pelaksanaan', 'code' => 'kontrak_pelaksanaan', 'description' => 'Kontrak pelaksanaan pekerjaan', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Rencana PCM', 'code' => 'rencana_pcm', 'description' => 'Rencana Pre Construction Meeting', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Rencana Persiapan Konstruksi', 'code' => 'rencana_persiapan', 'description' => 'Rencana pekerjaan persiapan konstruksi', 'category' => 'Dokumen Persiapan'],
            ['name' => 'BA Serah Terima Lahan', 'code' => 'ba_serah_terima', 'description' => 'Berita acara serah terima lahan', 'category' => 'Dokumen Persiapan'],
            ['name' => 'BA Pengukuran dan MC', 'code' => 'ba_pengukuran', 'description' => 'Berita acara pengukuran kembali lokasi pekerjaan (Uitzet) dan Mutual Check', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Hasil Review Pagu Anggaran Konstruksi', 'code' => 'review_pagu', 'description' => 'Hasil review pagu anggaran konstruksi', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Dokumen DED for Tender', 'code' => 'ded_tender', 'description' => 'Dokumen Detail Engineering Design untuk tender', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Hasil Penilaian Calon Penyedia Jasa', 'code' => 'penilaian_penyedia', 'description' => 'Hasil penilaian calon penyedia jasa sebagai rekomendasi kepada pemberi tugas', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Pengecekan Kesanggupan Supplier Material', 'code' => 'cek_supplier', 'description' => 'Dokumen pengecekan kesanggupan supplier material', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Reviu Spesifikasi Material', 'code' => 'reviu_spesifikasi', 'description' => 'Dokumen reviu spesifikasi material', 'category' => 'Dokumen Persiapan'],

            ['name' => 'Jaminan Pelaksanaan (jika ada)', 'code' => 'jaminan_pelaksanaan_konstruksi', 'description' => 'Dokumen jaminan pelaksanaan pekerjaan konstruksi', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Pengelolaan Kesehatan Kerja – Perlindungan Sosial Tenaga Kerja', 'code' => 'kesehatan_kerja', 'description' => 'Dokumen pengelolaan K3 dan perlindungan tenaga kerja', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Dokumen Kontrak Pelaksana Konstruksi', 'code' => 'kontrak_pelaksana', 'description' => 'Kontrak pelaksana pekerjaan konstruksi', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Surat Penyerahan Lokasi Pekerjaan', 'code' => 'penyerahan_lokasi', 'description' => 'Berita acara penyerahan lokasi pekerjaan kepada kontraktor', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Surat Perintah Mulai Kerja (SPMK)', 'code' => 'spmk', 'description' => 'Surat perintah mulai kerja dari PPK kepada kontraktor pelaksana', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Berita Acara PCM', 'code' => 'pcm_berita_acara', 'description' => 'Berita acara kegiatan rapat persiapan pelaksanaan kontrak (PCM)', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Struktur Organisasi Proyek', 'code' => 'struktur_organisasi', 'description' => 'Struktur organisasi proyek konstruksi', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Penanggung Jawab Kegiatan', 'code' => 'penanggung_jawab', 'description' => 'Penanggung jawab kegiatan proyek', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Pengawas Pekerjaan', 'code' => 'pengawas_pekerjaan', 'description' => 'Daftar pengawas pekerjaan', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Penyedia Jasa Pekerjaan Konstruksi', 'code' => 'penyedia_jasa', 'description' => 'Daftar penyedia jasa pekerjaan konstruksi', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Pendelegasian Kewenangan', 'code' => 'pendelegasian_kewenangan', 'description' => 'Dokumen pendelegasian kewenangan proyek', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Alur Komunikasi dan Persetujuan', 'code' => 'alur_komunikasi', 'description' => 'Dokumen alur komunikasi dan persetujuan proyek', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Mekanisme Pengawasan', 'code' => 'mekanisme_pengawasan', 'description' => 'Dokumen mekanisme pengawasan proyek', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Jadwal Pelaksanaan', 'code' => 'jadwal_pelaksanaan', 'description' => 'Jadwal pelaksanaan pekerjaan konstruksi', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Mobilisasi personil inti, peralatan, dan material', 'code' => 'mobilisasi', 'description' => 'Dokumen mobilisasi personil inti, peralatan, dan material', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Metode Pelaksanaan – Gambaran umum tiap tahapan pekerjaan konstruksi', 'code' => 'metode_pelaksanaan', 'description' => 'Metode pelaksanaan pekerjaan konstruksi', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Metode Pelaksanaan – Metode pelaksanaan pekerjaan tertentu', 'code' => 'metode_pelaksanaan_tertentu', 'description' => 'Metode pelaksanaan pekerjaan tertentu yang memerlukan perhatian khusus', 'category' => 'Dokumen Persiapan'],

            ['name' => 'Dokumen RKK', 'code' => 'dokumen_rkk', 'description' => 'Dokumen Rencana Keselamatan Konstruksi (RKK)', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Dokumen RMPK', 'code' => 'dokumen_rmpk', 'description' => 'Dokumen Rencana Mutu Pelaksanaan Konstruksi (RMPK)', 'category' => 'Dokumen Persiapan'],          
            ['name' => 'Dokumen RKPPPL (jika ada)', 'code' => 'dokumen_rkpppl', 'description' => 'Dokumen Rencana Keamanan dan Pengendalian Pencemaran Lingkungan (RKPPPL)', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Dokumen RMLLP (jika ada)', 'code' => 'dokumen_rmllp', 'description' => 'Dokumen Rencana Mitigasi dan Layanan Lalu Lintas Proyek (RMLLP)', 'category' => 'Dokumen Persiapan'],
            
            ['name' => 'Rencana Pemeriksaan Lapangan Bersama', 'code' => 'rencana_pemeriksaan_lapangan', 'description' => 'Dokumen rencana pemeriksaan lapangan bersama sebelum pelaksanaan pekerjaan', 'category' => 'Dokumen Persiapan'],

            ['name' => 'Tugas Konsultan MK – Mengecek kesanggupan supplier dan reviu spesifikasi', 'code' => 'mk_kesanggupan_supplier', 'description' => 'Mengecek kesanggupan supplier dan reviu spesifikasi teknis', 'category' => 'Dokumen Persiapan'],

            ['name' => 'Tugas Konsultan MK – Mengarahkan mutu pekerjaan dan spesifikasi', 'code' => 'mk_mutu_pekerjaan', 'description' => 'Mengatur dan mengarahkan mutu pekerjaan serta spesifikasinya', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Tugas Konsultan MK – Mengawasi terhadap aspek K3', 'code' => 'mk_aspek_k3', 'description' => 'Pengawasan Konsultan MK terhadap aspek keselamatan dan kesehatan kerja (K3)', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Tugas Konsultan MK – Koordinasi dan sosialisasi dengan pihak terkait', 'code' => 'mk_koordinasi', 'description' => 'Membantu proses koordinasi dan sosialisasi kegiatan konstruksi', 'category' => 'Dokumen Persiapan'],
            ['name' => 'Tugas Konsultan MK – Menganalisa master schedule dan tenaga kerja', 'code' => 'mk_master_schedule', 'description' => 'Menganalisa jadwal utama proyek dan daftar tenaga kerja', 'category' => 'Dokumen Persiapan'],

            // Dokumen Perizinan
            ['name' => 'Surat Keterangan Rencana', 'code' => 'skrk', 'description' => 'Surat Keterangan Rencana Kota/Kab', 'category' => 'Dokumen Perizinan'],
            ['name' => 'PBG', 'code' => 'pbg', 'description' => 'Persetujuan Bangunan Gedung (khususnya bangunan baru/perluasan)', 'category' => 'Dokumen Perizinan'],

            // Pembayaran dan Jaminan
            ['name' => 'Jaminan Uang Muka', 'code' => 'jaminan_um', 'description' => 'Jaminan Uang Muka', 'category' => 'Pembayaran dan Jaminan'],
            ['name' => 'BA Pembayaran Uang Muka', 'code' => 'ba_um', 'description' => 'Berita Acara Pembayaran Uang Muka', 'category' => 'Pembayaran dan Jaminan'],
            ['name' => 'Jaminan Pelaksanaan', 'code' => 'jaminan_pelaksanaan_pekerjaan', 'description' => 'Jaminan Pelaksanaan', 'category' => 'Pembayaran dan Jaminan']
        ];

        foreach ($documentTypes as $type) {
            DocumentType::updateOrCreate(
                ['code' => $type['code']],
                $type
            );
        }
    }
}