<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('master_user')->insert([
            [
                'nama' => 'Ical KSPI',
                'nip' => '11111111',
                'master_akses_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Budi Auditor',
                'nip' => '22222222',
                'master_akses_user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sari PIC Auditee',
                'nip' => '33333333',
                'master_akses_user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dewi BOD',
                'nip' => '44444444',
                'master_akses_user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 