<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerencanaanAuditSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('perencanaan_audit')->insert([
            [
                'tanggal_surat_tugas' => '2024-07-01',
                'nomor_surat_tugas' => 'ST-001',
                'jenis_audit' => 'Reguler',
                'auditor' => json_encode(['Auditor 1']),
                'auditee_id' => 1,
                'ruang_lingkup' => json_encode(['Lingkup 1']),
                'tanggal_audit_mulai' => '2024-07-10',
                'tanggal_audit_sampai' => '2024-07-15',
                'periode_audit' => '2024',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_surat_tugas' => '2024-07-02',
                'nomor_surat_tugas' => 'ST-002',
                'jenis_audit' => 'Khusus',
                'auditor' => json_encode(['Auditor 2']),
                'auditee_id' => 1,
                'ruang_lingkup' => json_encode(['Lingkup 2']),
                'tanggal_audit_mulai' => '2024-07-20',
                'tanggal_audit_sampai' => '2024-07-25',
                'periode_audit' => '2024',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 