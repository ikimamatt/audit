<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryMeeting extends Model
{
    use HasFactory;
    protected $table = 'entry_meeting';
    protected $guarded = [];

    public function auditee()
    {
        return $this->belongsTo(\App\Models\MasterData\MasterAuditee::class, 'auditee_id');
    }
} 