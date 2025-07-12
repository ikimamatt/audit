<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Audit\PerencanaanAudit;

class ProgramKerjaAuditSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID dari perencanaan audit yang sudah ada
        $perencanaanAudit = PerencanaanAudit::first();
        
        if (!$perencanaanAudit) {
            $this->command->warn('Tidak ada data perencanaan audit. Skipping ProgramKerjaAuditSeeder.');
            return;
        }

        DB::table('program_kerja_audit')->insert([
            [
                'perencanaan_audit_id' => $perencanaanAudit->id,
                'tanggal_pka' => '2024-07-01',
                'no_pka' => 'PKA-001/2024',
                'informasi_umum' => 'Informasi umum program kerja audit pertama',
                'kpi_tidak_tercapai' => 'KPI yang tidak tercapai dalam audit pertama',
                'data_awal_dokumen' => 'Data awal dokumen untuk audit pertama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perencanaan_audit_id' => $perencanaanAudit->id,
                'tanggal_pka' => '2024-08-01',
                'no_pka' => 'PKA-002/2024',
                'informasi_umum' => 'Informasi umum program kerja audit kedua',
                'kpi_tidak_tercapai' => 'KPI yang tidak tercapai dalam audit kedua',
                'data_awal_dokumen' => 'Data awal dokumen untuk audit kedua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 