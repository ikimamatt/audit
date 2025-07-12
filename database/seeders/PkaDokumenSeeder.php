<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Models\Audit\ProgramKerjaAudit;

class PkaDokumenSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID dari program kerja audit yang sudah ada
        $programKerjaAudit = ProgramKerjaAudit::first();
        
        if (!$programKerjaAudit) {
            $this->command->warn('Tidak ada data program kerja audit. Skipping PkaDokumenSeeder.');
            return;
        }

        DB::table('pka_dokumen')->insert([
            [
                'program_kerja_audit_id' => $programKerjaAudit->id,
                'nama_dokumen' => 'Dokumen 1',
                'file_path' => 'dokumen/dok1.pdf',
                'status_approval' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'program_kerja_audit_id' => $programKerjaAudit->id,
                'nama_dokumen' => 'Dokumen 2',
                'file_path' => 'dokumen/dok2.pdf',
                'status_approval' => 'approved',
                'approved_by' => 1,
                'approved_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 