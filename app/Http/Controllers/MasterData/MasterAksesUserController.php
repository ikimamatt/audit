<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\MasterAksesUser;

class MasterAksesUserController extends Controller
{
    public function index()
    {
        $data = MasterAksesUser::all();
        return view('tables.master_akses_user', compact('data'));
    }
} 