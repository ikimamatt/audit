<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Audit\PerencanaanAudit;

class TodBpmAuditSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID dari perencanaan audit yang sudah ada
        $perencanaanAudit = PerencanaanAudit::first();
        
        if (!$perencanaanAudit) {
            $this->command->warn('Tidak ada data perencanaan audit. Skipping TodBpmAuditSeeder.');
            return;
        }

        DB::table('tod_bpm_audit')->insert([
            [
                'perencanaan_audit_id' => $perencanaanAudit->id,
                'judul_bpm' => 'BPM Proses Bisnis 1',
                'nama_bpo' => 'BPO Satu',
                'file_bpm' => 'bpm/dummy1.pdf',
                'status_approval' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perencanaan_audit_id' => $perencanaanAudit->id,
                'judul_bpm' => 'BPM Proses Bisnis 2',
                'nama_bpo' => 'BPO Dua',
                'file_bpm' => 'bpm/dummy2.pdf',
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 