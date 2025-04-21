<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $documentTypes = [
            // Pre-tender Documents
            ['name' => 'Dokumen DED perencana', 'code' => 'ded_perencana', 'description' => 'Laporan DED dan Master Plan', 'category' => 'Pre-tender Documents'],
            ['name' => 'Notulensi hasil rapat koordinasi', 'code' => 'notulensi_koordinasi', 'description' => 'Notulensi hasil rapat koordinasi proses review penyusunan', 'category' => 'Pre-tender Documents'],
            ['name' => 'Laporan review penyusunan DED', 'code' => 'review_ded', 'description' => 'Laporan review penyusunan DED dan evaluasi', 'category' => 'Pre-tender Documents'],
            
            // Tender Documents
            ['name' => 'Tender Konsultan MK', 'code' => 'tender_mk', 'description' => 'Dokumen tender konsultan manajemen konstruksi', 'category' => 'Tender Documents'],
            ['name' => 'Hasil Review Pagu Anggaran', 'code' => 'review_anggaran', 'description' => 'Hasil review pagu anggaran konstruksi', 'category' => 'Tender Documents'],
            ['name' => 'Dokumen DED for Tender', 'code' => 'ded_tender', 'description' => 'Dokumen DED untuk proses tender', 'category' => 'Tender Documents'],
            ['name' => 'Hasil Penilaian Calon Penyedia', 'code' => 'penilaian_penyedia', 'description' => 'Hasil penilaian calon penyedia jasa', 'category' => 'Tender Documents'],
            ['name' => 'Pengecekan Supplier', 'code' => 'cek_supplier', 'description' => 'Pengecekan kesanggupan supplier material', 'category' => 'Tender Documents'],
            ['name' => 'Reviu Spesifikasi', 'code' => 'reviu_spesifikasi', 'description' => 'Reviu spesifikasi material', 'category' => 'Tender Documents'],
            
            // Construction Preparation Documents
            ['name' => 'Jaminan Pelaksanaan', 'code' => 'jaminan_pelaksanaan', 'description' => 'Dokumen jaminan pelaksanaan', 'category' => 'Construction Preparation Documents'],
            ['name' => 'Dokumen K3', 'code' => 'dok_k3', 'description' => 'Pengelolaan Kesehatan Kerja - Perlindungan Sosial Tenaga Kerja', 'category' => 'Construction Preparation Documents'],
            ['name' => 'Kontrak Pelaksana', 'code' => 'kontrak_pelaksana', 'description' => 'Dokumen Kontrak Pelaksana Konstruksi', 'category' => 'Construction Preparation Documents'],
            ['name' => 'Berita Acara Serah Terima', 'code' => 'bast_lokasi', 'description' => 'Berita Acara Penyerahan Lokasi Pekerjaan', 'category' => 'Construction Preparation Documents'],
            ['name' => 'SPMK', 'code' => 'spmk', 'description' => 'Surat Perintah Mulai Kerja Kontraktor Pelaksana', 'category' => 'Construction Preparation Documents'],
            ['name' => 'Dokumen PCM', 'code' => 'dok_pcm', 'description' => 'Dokumen Pre Construction Meeting', 'category' => 'Construction Preparation Documents'],
            ['name' => 'Struktur Organisasi', 'code' => 'struktur_organisasi', 'description' => 'Struktur Organisasi Proyek', 'category' => 'Construction Preparation Documents'],
            ['name' => 'Metode Pelaksanaan', 'code' => 'metode_pelaksanaan', 'description' => 'Metode Pelaksanaan Pekerjaan', 'category' => 'Construction Preparation Documents'],

            // Laporan Berkala
            ['name' => 'Laporan Bulanan', 'code' => 'laporan_bulanan', 'description' => 'Laporan kemajuan fisik pekerjaan bulanan', 'category' => 'Laporan Berkala'],
            ['name' => 'Laporan Mingguan', 'code' => 'laporan_mingguan', 'description' => 'Laporan kemajuan fisik pekerjaan mingguan', 'category' => 'Laporan Berkala'],
            ['name' => 'Laporan Harian', 'code' => 'laporan_harian', 'description' => 'Laporan kegiatan harian pekerjaan', 'category' => 'Laporan Berkala'],

            // Pengawasan Mutu
            ['name' => 'Metode Kerja', 'code' => 'metode_kerja', 'description' => 'Metode kerja pengawasan mutu pekerjaan', 'category' => 'Pengawasan Mutu'],
            ['name' => 'Pengawasan Proses', 'code' => 'pengawasan_proses', 'description' => 'Pengawasan terhadap proses tiap-tiap kegiatan', 'category' => 'Pengawasan Mutu'],
            ['name' => 'Pengawasan Hasil', 'code' => 'pengawasan_hasil', 'description' => 'Pengawasan terhadap hasil pekerjaan', 'category' => 'Pengawasan Mutu'],
            ['name' => 'Pemeriksaan Material', 'code' => 'pemeriksaan_material', 'description' => 'Pemeriksaan material saat penerimaan', 'category' => 'Pengawasan Mutu'],
            ['name' => 'Pengujian Material', 'code' => 'pengujian_material', 'description' => 'Pemeriksaan dan pengujian berkala material', 'category' => 'Pengawasan Mutu'],

            // Penerimaan dan Pembayaran
            ['name' => 'Berita Acara Pemeriksaan', 'code' => 'bap', 'description' => 'Berita acara hasil pemeriksaan bersama', 'category' => 'Penerimaan dan Pembayaran'],
            ['name' => 'Dokumen Tagihan', 'code' => 'dokumen_tagihan', 'description' => 'Dokumen tagihan sesuai kontrak', 'category' => 'Penerimaan dan Pembayaran'],
            ['name' => 'Hasil Pemeriksaan', 'code' => 'hasil_pemeriksaan', 'description' => 'Hasil pemeriksaan ketidaksesuaian spesifikasi', 'category' => 'Penerimaan dan Pembayaran'],

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