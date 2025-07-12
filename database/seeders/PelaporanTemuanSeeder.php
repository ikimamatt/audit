<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PelaporanTemuanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pelaporan_temuan')->insert([
            [
                'pelaporan_hasil_audit_id' => 1,
                'hasil_temuan' => 'Dokumentasi transaksi keuangan tidak lengkap dan tidak sesuai dengan standar akuntansi yang berlaku. Beberapa transaksi tidak memiliki bukti pendukung yang memadai.',
                'kode_aoi_id' => 1,
                'kode_risk_id' => 1,
                'nomor_iss' => 'ISS.001/PO PCN/SPI.01.02/01/01/2024',
                'tahun' => 2024,
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pelaporan_hasil_audit_id' => 1,
                'hasil_temuan' => 'Proses approval transaksi keuangan tidak dilakukan sesuai dengan hierarki yang telah ditetapkan. Beberapa transaksi dengan nilai besar tidak mendapat approval dari level manajemen yang sesuai.',
                'kode_aoi_id' => 2,
                'kode_risk_id' => 2,
                'nomor_iss' => 'ISS.001/PO PCN/SPI.01.02/01/02/2024',
                'tahun' => 2024,
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pelaporan_hasil_audit_id' => 2,
                'hasil_temuan' => 'Sistem pengendalian risiko operasional belum terintegrasi dengan baik. Identifikasi dan penilaian risiko tidak dilakukan secara sistematis dan berkelanjutan.',
                'kode_aoi_id' => 3,
                'kode_risk_id' => 3,
                'nomor_iss' => 'ISS.002/PO PCN/SPI.01.03/01/01/2024',
                'tahun' => 2024,
                'status_approval' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pelaporan_hasil_audit_id' => 2,
                'hasil_temuan' => 'Monitoring dan pelaporan risiko tidak dilakukan secara real-time. Informasi risiko tidak tersedia secara tepat waktu untuk pengambilan keputusan manajemen.',
                'kode_aoi_id' => 4,
                'kode_risk_id' => 4,
                'nomor_iss' => 'ISS.002/PO PCN/SPI.01.03/01/02/2024',
                'tahun' => 2024,
                'status_approval' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pelaporan_hasil_audit_id' => 3,
                'hasil_temuan' => 'Kepatuhan terhadap regulasi sektor keuangan belum optimal. Beberapa ketentuan regulator tidak diimplementasikan dengan baik dalam proses bisnis.',
                'kode_aoi_id' => 5,
                'kode_risk_id' => 5,
                'nomor_iss' => 'ISS.003/PO PCN/SPI.01.04/01/01/2024',
                'tahun' => 2024,
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pelaporan_hasil_audit_id' => 3,
                'hasil_temuan' => 'Sistem pelaporan kepatuhan tidak terintegrasi dan tidak menyediakan informasi yang komprehensif. Pelaporan kepada regulator sering terlambat dan tidak akurat.',
                'kode_aoi_id' => 1,
                'kode_risk_id' => 1,
                'nomor_iss' => 'ISS.003/PO PCN/SPI.01.04/01/02/2024',
                'tahun' => 2024,
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
} 