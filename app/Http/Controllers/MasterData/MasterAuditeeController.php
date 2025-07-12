<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\MasterAuditee;

class MasterAuditeeController extends Controller
{
    public function index()
    {
        $data = MasterAuditee::all();
        return view('master-data.auditee.index', compact('data'));
    }
} 