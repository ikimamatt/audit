<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use App\Models\Audit\PerencanaanAudit;
use App\Models\MasterData\MasterAuditee;
use App\Models\MasterData\MasterUser;
use Illuminate\Http\Request;

class PerencanaanAuditController extends Controller
{
    public function index()
    {
        $data = PerencanaanAudit::with('auditee')->get();
        return view('forms.tabel_perencanaan_audit', compact('data'));
    }

    public function create()
    {
        $auditees = MasterAuditee::all();
        $auditors = MasterUser::with('akses')->whereHas('akses', function($q) {
            $q->where('nama_akses', 'Auditor');
        })->get();
        return view('forms.perencanaan_audit', compact('auditees', 'auditors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_surat_tugas' => 'required|date',
            'nomor_surat_tugas' => 'required',
            'jenis_audit' => 'required',
            'auditor' => 'nullable|array',
            'auditee' => 'required|exists:master_auditee,id',
            'ruang_lingkup' => 'required|array',
            'tanggal_audit_mulai' => 'required|date',
            'tanggal_audit_sampai' => 'required|date',
            'periode_awal' => 'required',
            'periode_akhir' => 'required',
        ]);
        
        $perencanaan = PerencanaanAudit::create([
            'tanggal_surat_tugas' => $request->tanggal_surat_tugas,
            'nomor_surat_tugas' => $request->nomor_surat_tugas,
            'jenis_audit' => $request->jenis_audit,
            'auditor' => $request->auditor ?? [],
            'auditee_id' => $request->auditee,
            'ruang_lingkup' => $request->ruang_lingkup,
            'tanggal_audit_mulai' => $request->tanggal_audit_mulai,
            'tanggal_audit_sampai' => $request->tanggal_audit_sampai,
            'periode_audit' => $request->periode_awal . ' s/d ' . $request->periode_akhir,
        ]);
        
        // Redirect ke index dengan session data untuk modal
        return redirect()->route('audit.perencanaan.index')->with([
            'success' => 'Data perencanaan audit berhasil disimpan!',
            'nomor' => $perencanaan->nomor_surat_tugas
        ]);
    }

    public function edit($id)
    {
        $item = PerencanaanAudit::findOrFail($id);
        
        // Memisahkan periode_audit menjadi periode_awal dan periode_akhir
        if ($item->periode_audit) {
            $periodeParts = explode(' s/d ', $item->periode_audit);
            $item->periode_awal = $periodeParts[0] ?? '';
            $item->periode_akhir = $periodeParts[1] ?? '';
        }
        
        $auditees = MasterAuditee::all();
        $auditors = MasterUser::with('akses')->whereHas('akses', function($q) {
            $q->where('nama_akses', 'Auditor');
        })->get();
        return view('forms.perencanaan_audit', compact('item', 'auditees', 'auditors'));
    }

    public function update(Request $request, $id)
    {
        $item = PerencanaanAudit::findOrFail($id);
        $item->update([
            'tanggal_surat_tugas' => $request->tanggal_surat_tugas,
            'nomor_surat_tugas' => $request->nomor_surat_tugas,
            'jenis_audit' => $request->jenis_audit,
            'auditor' => $request->auditor ?? [],
            'auditee_id' => $request->auditee,
            'ruang_lingkup' => $request->ruang_lingkup,
            'tanggal_audit_mulai' => $request->tanggal_audit_mulai,
            'tanggal_audit_sampai' => $request->tanggal_audit_sampai,
            'periode_audit' => $request->periode_awal . ' s/d ' . $request->periode_akhir,
        ]);
        
        // Redirect ke index dengan session data untuk modal
        return redirect()->route('audit.perencanaan.index')->with([
            'success' => 'Data perencanaan audit berhasil diupdate!',
            'nomor' => $item->nomor_surat_tugas
        ]);
    }

    public function destroy($id)
    {
        $item = PerencanaanAudit::findOrFail($id);
        $item->delete();
        return redirect()->route('audit.perencanaan.index')->with('success', 'Data perencanaan audit berhasil dihapus!');
    }
} 