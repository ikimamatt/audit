<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\MasterKodeRisk;

class MasterKodeRiskController extends Controller
{
    public function index()
    {
        $data = MasterKodeRisk::all();
        return view('master-data.kode-risk.index', compact('data'));
    }
} 