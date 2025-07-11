<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoutingController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // $this->
        // middleware('auth')->
        // except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            return redirect('index');
        } else {
            return redirect('login');
        }
    }

    /**
     * Display a view based on first route param
     *
     * @return \Illuminate\Http\Response
     */
    public function root(Request $request, $first)
    {
        return view($first);
    }

    /**
     * second level route
     */
    public function secondLevel(Request $request, $first, $second)
    {
        return view($first . '.' . $second);
    }

    /**
     * third level route
     */
    public function thirdLevel(Request $request, $first, $second, $third)
    {
        return view($first . '.' . $second . '.' . $third);
    }

    public function perencanaanAuditForm()
    {
        $auditees = \App\Models\MasterAuditee::all();
        $auditors = \App\Models\MasterUser::with('akses')->whereHas('akses', function($q) {
            $q->where('nama_akses', 'Auditor');
        })->get();
        return view('forms.perencanaan_audit', compact('auditees', 'auditors'));
    }

    public function masterKodeAoi()
    {
        try {
            $data = \App\Models\MasterData\MasterKodeAoi::all();
            return view('tables.master_kode_aoi', compact('data'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function masterKodeRisk()
    {
        $data = \App\Models\MasterData\MasterKodeRisk::all();
        return view('tables.master_kode_risk', compact('data'));
    }

    public function masterAuditee()
    {
        $data = \App\Models\MasterData\MasterAuditee::all();
        return view('tables.master_auditee', compact('data'));
    }

    public function masterUser()
    {
        $data = \App\Models\MasterData\MasterUser::with('akses')->get();
        return view('tables.master_user', compact('data'));
    }

    public function masterAksesUser()
    {
        $data = \App\Models\MasterData\MasterAksesUser::all();
        return view('tables.master_akses_user', compact('data'));
    }

    public function tabelPerencanaanAudit()
    {
        $data = \App\Models\Audit\PerencanaanAudit::with('auditee')->get();
        return view('forms.tabel_perencanaan_audit', compact('data'));
    }
}
