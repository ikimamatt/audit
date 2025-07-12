<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MasterData\MasterAuditee;

class EntryMeetingSeeder extends Seeder
{
    public function run(): void
    {
        $auditee = MasterAuditee::first();
        if (!$auditee) {
            $this->command->warn('Tidak ada data auditee. Skipping EntryMeetingSeeder.');
            return;
        }
        DB::table('entry_meeting')->insert([
            [
                'tanggal' => now()->toDateString(),
                'auditee_id' => $auditee->id,
                'file_undangan' => 'entry_meeting/undangan_dummy.pdf',
                'file_absensi' => 'entry_meeting/absensi_dummy.pdf',
                'status_approval' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 