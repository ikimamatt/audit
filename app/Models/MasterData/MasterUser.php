<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUser extends Model
{
    use HasFactory;
    protected $table = 'master_user';
    protected $guarded = [];

    public function akses()
    {
        return $this->belongsTo(MasterAksesUser::class, 'master_akses_user_id');
    }
} 