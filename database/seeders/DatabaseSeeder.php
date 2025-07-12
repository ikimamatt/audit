<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Tapeli',
            'email' => 'demo@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Master data seeders (tidak bergantung pada tabel lain)
        $this->call(MasterKodeAoiSeeder::class);
        $this->call(MasterKodeRiskSeeder::class);
        $this->call(MasterAuditeeSeeder::class);
        $this->call(MasterAksesUserSeeder::class);
        $this->call(MasterUserSeeder::class);
        
        // PerencanaanAuditSeeder harus dijalankan terlebih dahulu
        $this->call(PerencanaanAuditSeeder::class);
        
        // ProgramKerjaAuditSeeder bergantung pada perencanaan_audit
        $this->call(ProgramKerjaAuditSeeder::class);
        
        // Seeder yang bergantung pada perencanaan_audit
        $this->call(WalkthroughAuditSeeder::class);
        $this->call(TodBpmAuditSeeder::class);
        $this->call(TodBpmEvaluasiSeeder::class);
        $this->call(JadwalPkptAuditSeeder::class);
        $this->call(PkaDokumenSeeder::class);
    }
}
