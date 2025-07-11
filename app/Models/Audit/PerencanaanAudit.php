<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterData\MasterAuditee;

class PerencanaanAudit extends Model
{
    use HasFactory;
    protected $table = 'perencanaan_audit';
    protected $guarded = [];
    protected $casts = [
        'auditor' => 'array',
        'ruang_lingkup' => 'array',
    ];

    public function auditee()
    {
        return $this->belongsTo(MasterAuditee::class, 'auditee_id');
    }
} 