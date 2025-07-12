<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\MasterKodeAoi;

class MasterKodeAoiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MasterKodeAoi::all();
        return view('tables.master_kode_aoi', compact('data'));
    }
} 