<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Audit\PelaporanHasilAudit;
use App\Models\Audit\PerencanaanAudit;
use App\Models\Models\Audit\PelaporanTemuan;
use App\Models\MasterData\MasterUser;

class PelaporanHasilAuditController extends Controller
{
    public function index()
    {
        $data = PelaporanHasilAudit::with(['perencanaanAudit', 'temuan'])->get();
        return view('audit.pelaporan.index', compact('data'));
    }

    public function create()
    {
        $suratTugas = PerencanaanAudit::all();
        return view('audit.pelaporan.create', compact('suratTugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'perencanaan_audit_id' => 'required|exists:perencanaan_audit,id',
            'nomor_lha_lhk' => 'required|string',
            'jenis_lha_lhk' => 'required|in:LHA,LHK',
            'po_audit_konsul' => 'required|in:PO AUDIT,KONSUL',
            'kode_spi' => 'required|in:SPI.01.02,SPI.01.03,SPI.01.04',
            'tahun' => 'required|digits:4',
            'nomor_iss' => 'required|string',
            'permasalahan' => 'nullable|string|max:5000',
            'penyebab_people' => 'nullable|string|max:1000',
            'penyebab_process' => 'nullable|string|max:1000',
            'penyebab_policy' => 'nullable|string|max:1000',
            'penyebab_system' => 'nullable|string|max:1000',
            'penyebab_eksternal' => 'nullable|string|max:1000',
            'kriteria' => 'nullable|string|max:5000',
            'dampak_terjadi' => 'nullable|string|max:1000',
            'dampak_potensi' => 'nullable|string|max:1000',
            'signifikan' => 'required|in:Tinggi,Medium,Rendah',
        ]);
        $pelaporan = PelaporanHasilAudit::create($request->all());
        return redirect()->route('audit.pelaporan-hasil-audit.index')->with('success', 'Data pelaporan hasil audit berhasil disimpan!');
    }

    public function edit($id)
    {
        $item = PelaporanHasilAudit::findOrFail($id);
        $suratTugas = PerencanaanAudit::all();
        return view('audit.pelaporan.edit', compact('item', 'suratTugas'));
    }

    public function update(Request $request, $id)
    {
        $item = PelaporanHasilAudit::findOrFail($id);
        $request->validate([
            'perencanaan_audit_id' => 'required|exists:perencanaan_audit,id',
            'nomor_lha_lhk' => 'required|string',
            'jenis_lha_lhk' => 'required|in:LHA,LHK',
            'po_audit_konsul' => 'required|in:PO AUDIT,KONSUL',
            'kode_spi' => 'required|in:SPI.01.02,SPI.01.03,SPI.01.04',
            'tahun' => 'required|digits:4',
            'nomor_iss' => 'required|string',
            'permasalahan' => 'nullable|string|max:5000',
            'penyebab_people' => 'nullable|string|max:1000',
            'penyebab_process' => 'nullable|string|max:1000',
            'penyebab_policy' => 'nullable|string|max:1000',
            'penyebab_system' => 'nullable|string|max:1000',
            'penyebab_eksternal' => 'nullable|string|max:1000',
            'kriteria' => 'nullable|string|max:5000',
            'dampak_terjadi' => 'nullable|string|max:1000',
            'dampak_potensi' => 'nullable|string|max:1000',
            'signifikan' => 'required|in:Tinggi,Medium,Rendah',
        ]);
        $item->update($request->all());
        return redirect()->route('audit.pelaporan-hasil-audit.index')->with('success', 'Data pelaporan hasil audit berhasil diupdate!');
    }

    public function destroy($id)
    {
        $item = PelaporanHasilAudit::findOrFail($id);
        $item->delete();
        return redirect()->route('audit.pelaporan-hasil-audit.index')->with('success', 'Data pelaporan hasil audit berhasil dihapus!');
    }

    public function approval($id, Request $request)
    {
        $item = PelaporanHasilAudit::findOrFail($id);
        if ($request->action == 'approve') {
            $item->status_approval = 'approved';
            $item->approved_by = auth()->id();
            $item->approved_at = now();
        } elseif ($request->action == 'reject') {
            $item->status_approval = 'rejected';
            $item->approved_by = auth()->id();
            $item->approved_at = now();
        }
        $item->save();
        return redirect()->back()->with('success', 'Status pelaporan hasil audit berhasil diubah!');
    }
}
