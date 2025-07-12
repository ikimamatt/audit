<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Audit\PerencanaanAudit;

class WalkthroughAuditSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID dari perencanaan audit yang sudah ada
        $perencanaanAudit = PerencanaanAudit::first();
        
        if (!$perencanaanAudit) {
            $this->command->warn('Tidak ada data perencanaan audit. Skipping WalkthroughAuditSeeder.');
            return;
        }

        DB::table('walkthrough_audit')->insert([
            [
                'perencanaan_audit_id' => $perencanaanAudit->id,
                'tanggal_walkthrough' => '2024-07-01',
                'auditee_nama' => 'Auditee Satu',
                'hasil_walkthrough' => 'Hasil walkthrough pertama.',
                'status_approval' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perencanaan_audit_id' => $perencanaanAudit->id,
                'tanggal_walkthrough' => '2024-07-02',
                'auditee_nama' => 'Auditee Dua',
                'hasil_walkthrough' => 'Hasil walkthrough kedua.',
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 