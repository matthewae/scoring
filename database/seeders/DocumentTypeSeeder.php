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
            ['name' => 'Dokumen DED perencana', 'code' => 'ded_perencana', 'description' => 'Laporan DED dan Master Plan'],
            ['name' => 'Notulensi hasil rapat koordinasi', 'code' => 'notulensi_koordinasi', 'description' => 'Notulensi hasil rapat koordinasi proses review penyusunan'],
            ['name' => 'Laporan review penyusunan DED', 'code' => 'review_ded', 'description' => 'Laporan review penyusunan DED dan evaluasi'],
            
            // Tender Documents
            ['name' => 'Tender Konsultan MK', 'code' => 'tender_mk', 'description' => 'Dokumen tender konsultan manajemen konstruksi'],
            ['name' => 'Hasil Review Pagu Anggaran', 'code' => 'review_anggaran', 'description' => 'Hasil review pagu anggaran konstruksi'],
            ['name' => 'Dokumen DED for Tender', 'code' => 'ded_tender', 'description' => 'Dokumen DED untuk proses tender'],
            ['name' => 'Hasil Penilaian Calon Penyedia', 'code' => 'penilaian_penyedia', 'description' => 'Hasil penilaian calon penyedia jasa'],
            ['name' => 'Pengecekan Supplier', 'code' => 'cek_supplier', 'description' => 'Pengecekan kesanggupan supplier material'],
            ['name' => 'Reviu Spesifikasi', 'code' => 'reviu_spesifikasi', 'description' => 'Reviu spesifikasi material'],
            
            // Construction Preparation Documents
            ['name' => 'Jaminan Pelaksanaan', 'code' => 'jaminan_pelaksanaan', 'description' => 'Dokumen jaminan pelaksanaan'],
            ['name' => 'Dokumen K3', 'code' => 'dok_k3', 'description' => 'Pengelolaan Kesehatan Kerja - Perlindungan Sosial Tenaga Kerja'],
            ['name' => 'Kontrak Pelaksana', 'code' => 'kontrak_pelaksana', 'description' => 'Dokumen Kontrak Pelaksana Konstruksi'],
            ['name' => 'Berita Acara Serah Terima', 'code' => 'bast_lokasi', 'description' => 'Berita Acara Penyerahan Lokasi Pekerjaan'],
            ['name' => 'SPMK', 'code' => 'spmk', 'description' => 'Surat Perintah Mulai Kerja Kontraktor Pelaksana'],
            ['name' => 'Dokumen PCM', 'code' => 'dok_pcm', 'description' => 'Dokumen Pre Construction Meeting'],
            ['name' => 'Struktur Organisasi', 'code' => 'struktur_organisasi', 'description' => 'Struktur Organisasi Proyek'],
            ['name' => 'Metode Pelaksanaan', 'code' => 'metode_pelaksanaan', 'description' => 'Metode Pelaksanaan Pekerjaan'],

            // Laporan Berkala
            ['name' => 'Laporan Bulanan', 'code' => 'laporan_bulanan', 'description' => 'Laporan kemajuan fisik pekerjaan bulanan'],
            ['name' => 'Laporan Mingguan', 'code' => 'laporan_mingguan', 'description' => 'Laporan kemajuan fisik pekerjaan mingguan'],
            ['name' => 'Laporan Harian', 'code' => 'laporan_harian', 'description' => 'Laporan kegiatan harian pekerjaan'],

            // Pengawasan Mutu
            ['name' => 'Metode Kerja', 'code' => 'metode_kerja', 'description' => 'Metode kerja pengawasan mutu pekerjaan'],
            ['name' => 'Pengawasan Proses', 'code' => 'pengawasan_proses', 'description' => 'Pengawasan terhadap proses tiap-tiap kegiatan'],
            ['name' => 'Pengawasan Hasil', 'code' => 'pengawasan_hasil', 'description' => 'Pengawasan terhadap hasil pekerjaan'],
            ['name' => 'Pemeriksaan Material', 'code' => 'pemeriksaan_material', 'description' => 'Pemeriksaan material saat penerimaan'],
            ['name' => 'Pengujian Material', 'code' => 'pengujian_material', 'description' => 'Pemeriksaan dan pengujian berkala material'],

            // Penerimaan dan Pembayaran
            ['name' => 'Berita Acara Pemeriksaan', 'code' => 'bap', 'description' => 'Berita acara hasil pemeriksaan bersama'],
            ['name' => 'Dokumen Tagihan', 'code' => 'dokumen_tagihan', 'description' => 'Dokumen tagihan sesuai kontrak'],
            ['name' => 'Hasil Pemeriksaan', 'code' => 'hasil_pemeriksaan', 'description' => 'Hasil pemeriksaan ketidaksesuaian spesifikasi'],

            // Pelaksanaan Konstruksi
            ['name' => 'Mutual Check', 'code' => 'mutual_check', 'description' => 'Pemeriksaan bersama (MC-0)'],
            ['name' => 'Izin Mulai Kerja', 'code' => 'izin_mulai_kerja', 'description' => 'Permohonan dan persetujuan izin mulai kerja'],
            ['name' => 'Shop Drawing', 'code' => 'shop_drawing', 'description' => 'Gambar kerja pelaksanaan konstruksi'],
            ['name' => 'As Built Drawing', 'code' => 'as_built_drawing', 'description' => 'Gambar sesuai pelaksanaan konstruksi'],

            // Kontrak Kritis
            ['name' => 'Surat Teguran', 'code' => 'surat_teguran', 'description' => 'Surat teguran untuk kontraktor'],
            ['name' => 'Show Cause Meeting', 'code' => 'scm', 'description' => 'Berita Acara Show Cause Meeting (SCM) I, II, dan III'],
            ['name' => 'Surat Peringatan', 'code' => 'surat_peringatan', 'description' => 'Surat Peringatan I, II, dan III'],

            // Pemutusan Kontrak dan Sanksi
            ['name' => 'BA Pemeriksaan Lapangan', 'code' => 'ba_pemeriksaan_lapangan', 'description' => 'Berita Acara Pemeriksaan Lapangan untuk Penilaian Progress Lapangan Kondisi Kritis'],
            ['name' => 'BA Pemeriksaan Administratif', 'code' => 'ba_pemeriksaan_administratif', 'description' => 'Berita Acara Pemeriksaan Administratif'],
            ['name' => 'Surat Pemutusan Kontrak', 'code' => 'surat_pemutusan', 'description' => 'Surat Pemutusan Pekerjaan/Pemutusan Kontrak oleh PPK'],
            ['name' => 'Usulan Sanksi Daftar Hitam', 'code' => 'usulan_sanksi', 'description' => 'Surat Usulan Penetapan Sanksi Daftar Hitam dari PPK'],
            ['name' => 'Pemberitahuan Sanksi', 'code' => 'pemberitahuan_sanksi', 'description' => 'Surat Pemberitahuan Usulan Penetapan Sanksi Daftar Hitam'],
            ['name' => 'Keberatan Sanksi', 'code' => 'keberatan_sanksi', 'description' => 'Surat Keberatan dari Penyedia Jasa'],
            ['name' => 'Rekomendasi APIP', 'code' => 'rekomendasi_apip', 'description' => 'Surat Rekomendasi Penetapan Sanksi Daftar Hitam dari APIP'],
            ['name' => 'Keputusan PA/KPA', 'code' => 'keputusan_pa', 'description' => 'Surat Keputusan Penetapan Sanksi Daftar Hitam dari PA/KPA'],

            // Perubahan Kontrak (Addendum)
            ['name' => 'Mutual Check Perubahan', 'code' => 'mc_perubahan', 'description' => 'Mutual Check (MC) perubahan'],
            ['name' => 'Contract Change Order', 'code' => 'cco', 'description' => 'Contract Change Order (CCO)'],
            ['name' => 'Addendum Kontrak', 'code' => 'addendum_kontrak', 'description' => 'Addendum Kontrak'],
            ['name' => 'BA Rapat Lapangan', 'code' => 'ba_rapat_lapangan', 'description' => 'Berita Acara Rapat Lapangan'],
            ['name' => 'Usulan Perubahan', 'code' => 'usulan_perubahan', 'description' => 'Usulan Perubahan dari Penyedia/Perintah tertulis'],
            ['name' => 'Kajian Teknis MK', 'code' => 'kajian_teknis_mk', 'description' => 'Kajian/Justifikasi Teknis Konsultan Pengawas/MK'],
            ['name' => 'Rekomendasi Perencana', 'code' => 'rekomendasi_perencana', 'description' => 'Rekomendasi Konsultan Perencana'],
            ['name' => 'BA Negosiasi', 'code' => 'ba_negosiasi', 'description' => 'Berita Acara Negosiasi Teknis dan Harga'],
            ['name' => 'Persetujuan Perubahan', 'code' => 'persetujuan_perubahan', 'description' => 'Persetujuan Perubahan atau Permutakhiran Program Mutu'],
        ];

        foreach ($documentTypes as $type) {
            DocumentType::create($type);
        }
    }
}