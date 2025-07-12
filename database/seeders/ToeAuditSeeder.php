<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Audit\PerencanaanAudit;

class ToeAuditSeeder extends Seeder
{
    public function run(): void
    {
        $perencanaanAudit = PerencanaanAudit::first();
        if (!$perencanaanAudit) {
            $this->command->warn('Tidak ada data perencanaan audit. Skipping ToeAuditSeeder.');
            return;
        }
        DB::table('toe_audit')->insert([
            [
                'perencanaan_audit_id' => $perencanaanAudit->id,
                'judul_bpm' => 'BPM TOE 1',
                'pengendalian_eksisting' => 'Pengendalian eksisting 1',
                'status_approval' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perencanaan_audit_id' => $perencanaanAudit->id,
                'judul_bpm' => 'BPM TOE 2',
                'pengendalian_eksisting' => 'Pengendalian eksisting 2',
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 