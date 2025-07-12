<?php

namespace App\Models\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanHasilAudit extends Model
{
    use HasFactory;

    protected $table = 'pelaporan_hasil_audit';

    protected $fillable = [
        'perencanaan_audit_id',
        'nomor_lha_lhk',
        'jenis_lha_lhk',
        'po_audit_konsul',
        'kode_spi',
        'tahun',
        'status_approval',
        'approved_by',
        'approved_at',
        // Tambahan field baru:
        'nomor_iss',
        'permasalahan',
        'penyebab_people',
        'penyebab_process',
        'penyebab_policy',
        'penyebab_system',
        'penyebab_eksternal',
        'kriteria',
        'dampak_terjadi',
        'dampak_potensi',
        'signifikan',
    ];

    public function perencanaanAudit()
    {
        return $this->belongsTo(\App\Models\Audit\PerencanaanAudit::class, 'perencanaan_audit_id');
    }

    public function temuan()
    {
        return $this->hasMany(PelaporanTemuan::class, 'pelaporan_hasil_audit_id');
    }

    public function approver()
    {
        return $this->belongsTo(\App\Models\MasterData\MasterUser::class, 'approved_by');
    }
}
