<?php

namespace App\Models\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanIsiLha extends Model
{
    use HasFactory;

    protected $table = 'pelaporan_isi_lha';

    protected $fillable = [
        'pelaporan_hasil_audit_id',
        'nomor_iss',
        'permasalahan',
        'penyebab',
        'kriteria',
        'dampak_terjadi',
        'dampak_potensi',
        'signifikansi',
        'status_approval',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function pelaporanHasilAudit()
    {
        return $this->belongsTo(PelaporanHasilAudit::class, 'pelaporan_hasil_audit_id');
    }

    public function approver()
    {
        return $this->belongsTo(\App\Models\MasterData\MasterUser::class, 'approved_by');
    }
} 