<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\MasterKodeRisk;

class MasterKodeRiskController extends Controller
{
    public function index()
    {
        $data = MasterKodeRisk::all();
        return view('tables.master_kode_risk', compact('data'));
    }
} 