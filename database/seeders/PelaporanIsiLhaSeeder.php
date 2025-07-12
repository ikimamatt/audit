<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PelaporanIsiLhaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pelaporan_isi_lha')->insert([
            [
                'pelaporan_hasil_audit_id' => 1,
                'nomor_iss' => 'ISS.001/PO PCN/SPI.01.02/01/01/2024',
                'permasalahan' => 'Proses pengendalian internal pada divisi keuangan belum sesuai dengan standar operasional prosedur yang telah ditetapkan.',
                'penyebab' => 'Kombinasi dari kurangnya pemahaman karyawan terhadap SOP yang berlaku, proses workflow yang tidak terstruktur dengan baik, kebijakan yang belum jelas dan tidak terkomunikasikan dengan baik, sistem informasi yang belum terintegrasi dengan optimal, serta perubahan regulasi yang belum diadaptasi dengan cepat.',
                'kriteria' => 'Sesuai dengan standar pengendalian internal yang berlaku dan best practices industri.',
                'dampak_terjadi' => 'Terjadi kesalahan dalam pencatatan transaksi keuangan yang mengakibatkan laporan keuangan tidak akurat dan dapat mempengaruhi keputusan bisnis yang diambil oleh manajemen.',
                'dampak_potensi' => 'Potensi kerugian finansial yang signifikan, penurunan kredibilitas laporan keuangan, serta kemungkinan pelanggaran terhadap standar akuntansi yang berlaku.',
                'signifikansi' => 'Tinggi',
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pelaporan_hasil_audit_id' => 2,
                'nomor_iss' => 'ISS.002/PO PCN/SPI.01.03/01/01/2024',
                'permasalahan' => 'Sistem pengendalian risiko operasional belum optimal dalam mengidentifikasi dan mengelola risiko.',
                'penyebab' => 'Kurangnya kompetensi dalam manajemen risiko, proses identifikasi risiko yang tidak sistematis, kebijakan manajemen risiko yang belum komprehensif, sistem monitoring risiko yang belum real-time, serta dinamika lingkungan bisnis yang cepat berubah.',
                'kriteria' => 'Sesuai dengan framework manajemen risiko yang diakui secara internasional.',
                'dampak_terjadi' => 'Beberapa risiko operasional tidak terdeteksi tepat waktu yang mengganggu kelancaran operasional dan efisiensi proses bisnis.',
                'dampak_potensi' => 'Potensi gangguan operasional yang lebih besar, kerugian bisnis yang tidak terduga, serta penurunan kinerja organisasi secara keseluruhan.',
                'signifikansi' => 'Medium',
                'status_approval' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pelaporan_hasil_audit_id' => 3,
                'nomor_iss' => 'ISS.003/PO PCN/SPI.01.04/01/01/2024',
                'permasalahan' => 'Kepatuhan terhadap regulasi dan kebijakan internal belum konsisten di seluruh unit kerja.',
                'penyebab' => 'Kesadaran kepatuhan yang masih rendah di beberapa unit, proses monitoring kepatuhan yang tidak terstruktur, kebijakan kepatuhan yang belum terintegrasi dengan baik, sistem pelaporan kepatuhan yang belum otomatis, serta perubahan regulasi yang sering terjadi.',
                'kriteria' => 'Sesuai dengan standar kepatuhan yang berlaku dan regulasi yang terkait.',
                'dampak_terjadi' => 'Beberapa pelanggaran regulasi tidak terdeteksi yang dapat mengakibatkan sanksi dari regulator dan penurunan reputasi perusahaan.',
                'dampak_potensi' => 'Potensi sanksi regulator yang lebih berat, kerugian reputasi yang signifikan, serta kemungkinan kehilangan kepercayaan dari stakeholder.',
                'signifikansi' => 'Tinggi',
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pelaporan_hasil_audit_id' => 1,
                'nomor_iss' => 'ISS.001/PO PCN/SPI.01.02/01/02/2024',
                'permasalahan' => 'Dokumentasi dan bukti pendukung transaksi keuangan tidak lengkap dan tidak sesuai dengan standar akuntansi yang berlaku.',
                'penyebab' => 'Kurangnya pemahaman terhadap pentingnya dokumentasi yang lengkap, tidak adanya prosedur yang jelas untuk penyimpanan dokumen, serta tidak adanya sistem monitoring untuk kelengkapan dokumen.',
                'kriteria' => 'Sesuai dengan standar akuntansi yang berlaku dan prinsip audit yang diakui.',
                'dampak_terjadi' => 'Kesulitan dalam melakukan audit trail dan validasi transaksi, serta potensi kesalahan dalam pelaporan keuangan yang dapat mempengaruhi akurasi laporan.',
                'dampak_potensi' => 'Potensi kesalahan yang lebih besar dalam pelaporan keuangan, kesulitan dalam proses audit eksternal, serta kemungkinan pelanggaran terhadap prinsip akuntansi yang berlaku.',
                'signifikansi' => 'Tinggi',
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pelaporan_hasil_audit_id' => 2,
                'nomor_iss' => 'ISS.002/PO PCN/SPI.01.03/01/02/2024',
                'permasalahan' => 'Monitoring dan pelaporan risiko tidak dilakukan secara real-time dan tidak menyediakan informasi yang komprehensif.',
                'penyebab' => 'Sistem monitoring yang belum terintegrasi, tidak adanya dashboard real-time untuk monitoring risiko, serta tidak adanya prosedur pelaporan yang sistematis.',
                'kriteria' => 'Sesuai dengan standar monitoring risiko yang diakui dan kebutuhan manajemen.',
                'dampak_terjadi' => 'Informasi risiko tidak tersedia secara tepat waktu untuk pengambilan keputusan manajemen yang dapat mempengaruhi efektivitas pengelolaan risiko.',
                'dampak_potensi' => 'Potensi pengambilan keputusan yang tidak optimal, keterlambatan dalam respons terhadap risiko yang muncul, serta kemungkinan kerugian yang lebih besar akibat tidak terdeteksinya risiko secara dini.',
                'signifikansi' => 'Medium',
                'status_approval' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
} 