<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAuditee extends Model
{
    use HasFactory;
    protected $table = 'master_auditee';
    protected $guarded = [];
} 