<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterAuditeeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('master_auditee')->insert([
            // OPERASI & PENGEMBANGAN USAHA
            ['direktorat' => 'OPERASI & PENGEMBANGAN USAHA', 'divisi_cabang' => 'Divisi Operasi'],
            ['direktorat' => 'OPERASI & PENGEMBANGAN USAHA', 'divisi_cabang' => 'Divisi Perencanaan Dan Pengembangan Usaha & IT'],
            // KEUANGAN DAN ADMINISTRASI
            ['direktorat' => 'KEUANGAN DAN ADMINISTRASI', 'divisi_cabang' => 'Divisi Keuangan'],
            ['direktorat' => 'KEUANGAN DAN ADMINISTRASI', 'divisi_cabang' => 'Divisi Human Capital dan Administrasi Umum'],
            // SEKRETARIAT PERUSAHAAN
            ['direktorat' => 'SEKRETARIAT PERUSAHAAN', 'divisi_cabang' => 'Sub Bidang Komunikasi & Tata Kelola'],
            ['direktorat' => 'SEKRETARIAT PERUSAHAAN', 'divisi_cabang' => 'Sub Bidang Pelaksana Pengadaan'],
            ['direktorat' => 'SEKRETARIAT PERUSAHAAN', 'divisi_cabang' => 'Sub Bidang Kinerja dan Manajemen Risiko'],
            ['direktorat' => 'SEKRETARIAT PERUSAHAAN', 'divisi_cabang' => 'Sub Hukum & Kepatuhan'],
            // CABANG/SITE
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Cabang Kalimantan Timur & Utara'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Cabang Kalimantan Barat'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Cabang Kalimantan Selatan & Tengah'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Site Samarinda'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Site Berau'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Site Palangkaraya'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Site Singkawang'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Site NTB'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Site NTT'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Site Makasar'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Site Kendari'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Site Palu'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Site manado'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Site Maluku'],
            ['direktorat' => 'CABANG/SITE', 'divisi_cabang' => 'Cabang Papua'],
        ]);
    }
} 