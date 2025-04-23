<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
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
            ['name' => 'Jaminan Pelaksanaan', 'code' => 'jaminan_pelaksanaan_pekerjaan', 'description' => 'Jaminan Pelaksanaan', 'category' => 'Pembayaran dan Jaminan'],

            // Schedule dan Perencanaan
            ['name' => 'Schedule Peralatan', 'code' => 'schedule_alat', 'description' => 'Jadwal penggunaan peralatan', 'category' => 'Schedule dan Perencanaan'],
            ['name' => 'Schedule Personil', 'code' => 'schedule_personil', 'description' => 'Jadwal personil inti dan pendukung', 'category' => 'Schedule dan Perencanaan'],
            ['name' => 'Schedule Material', 'code' => 'schedule_material', 'description' => 'Jadwal pengadaan material', 'category' => 'Schedule dan Perencanaan'],

            ['name' => 'Kerangka Acuan Kerja Konsultan MK – Masukan Teknis', 'code' => 'kak_mk_masukan_teknis', 'description' => 'Masukan teknis kepada pengelola proyek oleh Konsultan MK, termasuk pengelola administrasi, keuangan, dan teknis', 'category' => 'KAK Konsultan MK'],
            ['name' => 'Kerangka Acuan Kerja Konsultan MK – Sasaran Kegiatan', 'code' => 'kak_mk_sasaran_kegiatan', 'description' => 'Sasaran kegiatan Konsultan MK seperti review perencanaan, manajemen kontrak, pelaksanaan pekerjaan, dan pengawasan', 'category' => 'KAK Konsultan MK'],
            ['name' => 'Kerangka Acuan Kerja Konsultan MK – Waktu Pelaksanaan', 'code' => 'kak_mk_waktu_pelaksanaan', 'description' => 'Waktu pelaksanaan kegiatan Konsultan MK dalam proyek konstruksi', 'category' => 'KAK Konsultan MK'],
            ['name' => 'Kerangka Acuan Kerja Konsultan MK – Tujuan Konsultan MK', 'code' => 'kak_mk_tujuan', 'description' => 'Tujuan Konsultan MK dalam proyek, seperti pengelolaan, pengendalian, monitoring, evaluasi, dan pengawasan pelaksanaan konstruksi', 'category' => 'KAK Konsultan MK'],

            // Keluaran Konsultan MK
            ['name' => 'Laporan Persiapan', 'code' => 'mk_lap_persiapan', 'description' => 'Laporan dan Berita Acara Persiapan Pelaksanaan', 'category' => 'Keluaran Konsultan MK'],
            ['name' => 'Buku Harian', 'code' => 'mk_buku_harian', 'description' => 'Buku harian yang memuat kejadian dan perintah penting', 'category' => 'Keluaran Konsultan MK'],
            ['name' => 'Laporan Harian', 'code' => 'mk_lap_harian', 'description' => 'Laporan harian kegiatan', 'category' => 'Keluaran Konsultan MK'],
            ['name' => 'Laporan Mingguan dan Bulanan', 'code' => 'mk_lap_periodik', 'description' => 'Laporan mingguan dan bulanan sesuai resume laporan harian', 'category' => 'Keluaran Konsultan MK'],
            ['name' => 'BA Kemajuan Pekerjaan', 'code' => 'mk_ba_progress', 'description' => 'Berita Acara Kemajuan Pekerjaan untuk pembayaran angsuran', 'category' => 'Keluaran Konsultan MK'],
            ['name' => 'Surat Perintah Perubahan', 'code' => 'mk_surat_perubahan', 'description' => 'Surat Perintah Perubahan Pekerjaan', 'category' => 'Keluaran Konsultan MK'],
            ['name' => 'As-built Drawing', 'code' => 'mk_as_built_drawing', 'description' => 'Gambar sesuai dengan pelaksanaan dan manual peralatan', 'category' => 'Keluaran Konsultan MK'],
            ['name' => 'Laporan Site Meeting', 'code' => 'mk_lap_meeting', 'description' => 'Laporan rapat di lapangan', 'category' => 'Keluaran Konsultan MK'],
            ['name' => 'Shop Drawing', 'code' => 'mk_shop_drawing_doc', 'description' => 'Gambar rincian pelaksanaan dan time schedule', 'category' => 'Keluaran Konsultan MK'],
            ['name' => 'Foto Dokumentasi', 'code' => 'mk_foto', 'description' => 'Foto dokumentasi (0%, 30%, 50%, 75%, 100%)', 'category' => 'Keluaran Konsultan MK'],
            ['name' => 'Laporan Akhir', 'code' => 'mk_lap_akhir', 'description' => 'Laporan akhir pekerjaan manajemen', 'category' => 'Keluaran Konsultan MK'],

            // Pemeriksaan dan Mutual Check
            ['name' => 'Pemeriksaan Gambar Kerja', 'code' => 'mc_gambar', 'description' => 'Pemeriksaan gambar kerja', 'category' => 'Pemeriksaan dan Mutual Check'],
            ['name' => 'Pemeriksaan Metode Kerja', 'code' => 'mc_metode', 'description' => 'Pemeriksaan metode kerja konstruksi', 'category' => 'Pemeriksaan dan Mutual Check'],
            ['name' => 'Rencana Pemeriksaan', 'code' => 'mc_rencana', 'description' => 'Rencana pemeriksaan dan pengujian', 'category' => 'Pemeriksaan dan Mutual Check'],
            ['name' => 'MC-0 Desain Awal', 'code' => 'mc0_desain', 'description' => 'Pemeriksaan terhadap desain awal', 'category' => 'Pemeriksaan dan Mutual Check'],
            ['name' => 'Review Desain', 'code' => 'mc0_review', 'description' => 'Penyesuaian desain/review desain', 'category' => 'Pemeriksaan dan Mutual Check'],
            ['name' => 'Penyesuaian Kuantitas', 'code' => 'mc0_kuantitas', 'description' => 'Penyesuaian kuantitas berdasarkan review desain', 'category' => 'Pemeriksaan dan Mutual Check'],
            ['name' => 'BA MC-0', 'code' => 'mc0_ba', 'description' => 'Berita Acara Hasil Pemeriksaan Bersama (MC-0)', 'category' => 'Pemeriksaan dan Mutual Check'],
            ['name' => 'Site Instruction', 'code' => 'mc_site_instruction', 'description' => 'Instruksi lapangan', 'category' => 'Pemeriksaan dan Mutual Check'],

            // Pengajuan Izin Kerja
            ['name' => 'Request of Work', 'code' => 'izin_kerja', 'description' => 'Permohonan Izin Memulai Pekerjaan', 'category' => 'Pengajuan Izin Kerja'],
            ['name' => 'Shop Drawing P-03', 'code' => 'izin_shop_drawing', 'description' => 'Gambar Kerja mengacu pada Prosedur (P-03)', 'category' => 'Pengajuan Izin Kerja'],
            ['name' => 'Hasil Pemeriksaan', 'code' => 'hasil_pemeriksaan', 'description' => 'Hasil pemeriksaan ketidaksesuaian spesifikasi', 'category' => 'Penerimaan dan Pembayaran'],
//masih harus ditambahkan 

            // Pelaksanaan Konstruksi
            ['name' => 'Mutual Check', 'code' => 'mutual_check', 'description' => 'Pemeriksaan bersama (MC-0)', 'category' => 'Pelaksanaan Konstruksi'],
            ['name' => 'Izin Mulai Kerja', 'code' => 'izin_mulai_kerja', 'description' => 'Permohonan dan persetujuan izin mulai kerja', 'category' => 'Pelaksanaan Konstruksi'],
            ['name' => 'Shop Drawing', 'code' => 'shop_drawing', 'description' => 'Gambar kerja pelaksanaan konstruksi', 'category' => 'Pelaksanaan Konstruksi'],
            ['name' => 'As Built Drawing', 'code' => 'as_built_drawing', 'description' => 'Gambar sesuai pelaksanaan konstruksi', 'category' => 'Pelaksanaan Konstruksi'],

            // Kontrak Kritis
            ['name' => 'Surat Teguran', 'code' => 'surat_teguran', 'description' => 'Surat teguran untuk kontraktor', 'category' => 'Kontrak Kritis'],
            ['name' => 'Show Cause Meeting', 'code' => 'scm', 'description' => 'Berita Acara Show Cause Meeting (SCM) I, II, dan III', 'category' => 'Kontrak Kritis'],
            ['name' => 'Surat Peringatan', 'code' => 'surat_peringatan', 'description' => 'Surat Peringatan I, II, dan III', 'category' => 'Kontrak Kritis'],

            // Pemutusan Kontrak dan Sanksi
            ['name' => 'BA Pemeriksaan Lapangan', 'code' => 'ba_pemeriksaan_lapangan', 'description' => 'Berita Acara Pemeriksaan Lapangan untuk Penilaian Progress Lapangan Kondisi Kritis', 'category' => 'Pemutusan Kontrak dan Sanksi'],
            ['name' => 'BA Pemeriksaan Administratif', 'code' => 'ba_pemeriksaan_administratif', 'description' => 'Berita Acara Pemeriksaan Administratif', 'category' => 'Pemutusan Kontrak dan Sanksi'],
            ['name' => 'Surat Pemutusan Kontrak', 'code' => 'surat_pemutusan', 'description' => 'Surat Pemutusan Pekerjaan/Pemutusan Kontrak oleh PPK', 'category' => 'Pemutusan Kontrak dan Sanksi'],
            ['name' => 'Usulan Sanksi Daftar Hitam', 'code' => 'usulan_sanksi', 'description' => 'Surat Usulan Penetapan Sanksi Daftar Hitam dari PPK', 'category' => 'Pemutusan Kontrak dan Sanksi'],
            ['name' => 'Pemberitahuan Sanksi', 'code' => 'pemberitahuan_sanksi', 'description' => 'Surat Pemberitahuan Usulan Penetapan Sanksi Daftar Hitam', 'category' => 'Pemutusan Kontrak dan Sanksi'],
            ['name' => 'Keberatan Sanksi', 'code' => 'keberatan_sanksi', 'description' => 'Surat Keberatan dari Penyedia Jasa', 'category' => 'Pemutusan Kontrak dan Sanksi'],
            ['name' => 'Rekomendasi APIP', 'code' => 'rekomendasi_apip', 'description' => 'Surat Rekomendasi Penetapan Sanksi Daftar Hitam dari APIP', 'category' => 'Pemutusan Kontrak dan Sanksi'],
            ['name' => 'Keputusan PA/KPA', 'code' => 'keputusan_pa', 'description' => 'Surat Keputusan Penetapan Sanksi Daftar Hitam dari PA/KPA', 'category' => 'Pemutusan Kontrak dan Sanksi'],

            // Perubahan Kontrak (Addendum)
            ['name' => 'Mutual Check Perubahan', 'code' => 'mc_perubahan', 'description' => 'Mutual Check (MC) perubahan', 'category' => 'Perubahan Kontrak (Addendum)'],
            ['name' => 'Contract Change Order', 'code' => 'cco', 'description' => 'Contract Change Order (CCO)', 'category' => 'Perubahan Kontrak (Addendum)'],
            ['name' => 'Addendum Kontrak', 'code' => 'addendum_kontrak', 'description' => 'Addendum Kontrak', 'category' => 'Perubahan Kontrak (Addendum)'],
            ['name' => 'BA Rapat Lapangan', 'code' => 'ba_rapat_lapangan', 'description' => 'Berita Acara Rapat Lapangan', 'category' => 'Perubahan Kontrak (Addendum)'],
            ['name' => 'Usulan Perubahan', 'code' => 'usulan_perubahan', 'description' => 'Usulan Perubahan dari Penyedia/Perintah tertulis', 'category' => 'Perubahan Kontrak (Addendum)'],
            ['name' => 'Kajian Teknis MK', 'code' => 'kajian_teknis_mk', 'description' => 'Kajian/Justifikasi Teknis Konsultan Pengawas/MK', 'category' => 'Perubahan Kontrak (Addendum)'],
            ['name' => 'Rekomendasi Perencana', 'code' => 'rekomendasi_perencana', 'description' => 'Rekomendasi Konsultan Perencana', 'category' => 'Perubahan Kontrak (Addendum)'],
            ['name' => 'BA Negosiasi', 'code' => 'ba_negosiasi', 'description' => 'Berita Acara Negosiasi Teknis dan Harga', 'category' => 'Perubahan Kontrak (Addendum)'],
            ['name' => 'Persetujuan Perubahan', 'code' => 'persetujuan_perubahan', 'description' => 'Persetujuan Perubahan atau Permutakhiran Program Mutu', 'category' => 'Perubahan Kontrak (Addendum)']
        ];

        foreach ($documentTypes as $type) {
            DocumentType::create($type);
        }
    }
}