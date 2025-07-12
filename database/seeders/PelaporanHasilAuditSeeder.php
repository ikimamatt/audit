<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PelaporanHasilAuditSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pelaporan_hasil_audit')->insert([
            [
                'perencanaan_audit_id' => 1,
                'nomor_lha_lhk' => '001.LHA/PO/SPI.01.02/SPI.PCN/2024',
                'jenis_lha_lhk' => 'LHA',
                'po_audit_konsul' => 'PO AUDIT',
                'kode_spi' => 'SPI.01.02',
                'tahun' => 2024,
                'nomor_iss' => 'ISS.001/PO PCN/SPI.01.02/01/01/2024',
                'permasalahan' => 'Proses pengendalian internal pada divisi keuangan belum sesuai dengan standar operasional prosedur yang telah ditetapkan.',
                'penyebab_people' => 'Kurangnya pemahaman karyawan terhadap SOP yang berlaku.',
                'penyebab_process' => 'Proses workflow yang tidak terstruktur dengan baik.',
                'penyebab_policy' => 'Kebijakan yang belum jelas dan tidak terkomunikasikan dengan baik.',
                'penyebab_system' => 'Sistem informasi yang belum terintegrasi dengan optimal.',
                'penyebab_eksternal' => 'Perubahan regulasi yang belum diadaptasi dengan cepat.',
                'kriteria' => 'Sesuai dengan standar pengendalian internal yang berlaku.',
                'dampak_terjadi' => 'Terjadi kesalahan dalam pencatatan transaksi keuangan.',
                'dampak_potensi' => 'Potensi kerugian finansial dan reputasi perusahaan.',
                'signifikan' => 'Tinggi',
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'perencanaan_audit_id' => 1,
                'nomor_lha_lhk' => '002.LHK/KONSUL/SPI.01.03/SPI.PCN/2024',
                'jenis_lha_lhk' => 'LHK',
                'po_audit_konsul' => 'KONSUL',
                'kode_spi' => 'SPI.01.03',
                'tahun' => 2024,
                'nomor_iss' => 'ISS.002/PO PCN/SPI.01.03/01/01/2024',
                'permasalahan' => 'Sistem pengendalian risiko operasional belum optimal dalam mengidentifikasi dan mengelola risiko.',
                'penyebab_people' => 'Kurangnya kompetensi dalam manajemen risiko.',
                'penyebab_process' => 'Proses identifikasi risiko yang tidak sistematis.',
                'penyebab_policy' => 'Kebijakan manajemen risiko yang belum komprehensif.',
                'penyebab_system' => 'Sistem monitoring risiko yang belum real-time.',
                'penyebab_eksternal' => 'Dinamika lingkungan bisnis yang cepat berubah.',
                'kriteria' => 'Sesuai dengan framework manajemen risiko yang diakui.',
                'dampak_terjadi' => 'Beberapa risiko operasional tidak terdeteksi tepat waktu.',
                'dampak_potensi' => 'Potensi gangguan operasional dan kerugian bisnis.',
                'signifikan' => 'Medium',
                'status_approval' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'perencanaan_audit_id' => 1,
                'nomor_lha_lhk' => '003.LHA/PO/SPI.01.04/SPI.PCN/2024',
                'jenis_lha_lhk' => 'LHA',
                'po_audit_konsul' => 'PO AUDIT',
                'kode_spi' => 'SPI.01.04',
                'tahun' => 2024,
                'nomor_iss' => 'ISS.003/PO PCN/SPI.01.04/01/01/2024',
                'permasalahan' => 'Kepatuhan terhadap regulasi dan kebijakan internal belum konsisten di seluruh unit kerja.',
                'penyebab_people' => 'Kesadaran kepatuhan yang masih rendah di beberapa unit.',
                'penyebab_process' => 'Proses monitoring kepatuhan yang tidak terstruktur.',
                'penyebab_policy' => 'Kebijakan kepatuhan yang belum terintegrasi dengan baik.',
                'penyebab_system' => 'Sistem pelaporan kepatuhan yang belum otomatis.',
                'penyebab_eksternal' => 'Perubahan regulasi yang sering terjadi.',
                'kriteria' => 'Sesuai dengan standar kepatuhan yang berlaku.',
                'dampak_terjadi' => 'Beberapa pelanggaran regulasi tidak terdeteksi.',
                'dampak_potensi' => 'Potensi sanksi regulator dan kerugian reputasi.',
                'signifikan' => 'Tinggi',
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
} 