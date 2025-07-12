<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\MasterUser;

class MasterUserController extends Controller
{
    public function index()
    {
        $data = MasterUser::with('akses')->get();
        return view('tables.master_user', compact('data'));
    }
} 