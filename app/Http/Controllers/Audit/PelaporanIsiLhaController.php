<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use App\Models\Models\Audit\PelaporanHasilAudit;
use App\Models\Models\Audit\PelaporanIsiLha;
use Illuminate\Http\Request;

class PelaporanIsiLhaController extends Controller
{
    public function index()
    {
        $data = PelaporanIsiLha::with(['pelaporanHasilAudit', 'approver'])->get();
        return view('audit.pelaporan.isi-lha.index', compact('data'));
    }

    public function create()
    {
        // Fetch all judul LHA/LHK for dropdown
        $judulLhaLhk = PelaporanHasilAudit::select('id', 'nomor_lha_lhk', 'nomor_iss')->get();
        return view('audit.pelaporan.isi-lha.create', compact('judulLhaLhk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelaporan_hasil_audit_id' => 'required|exists:pelaporan_hasil_audit,id',
            'permasalahan' => 'required|string|max:1000',
            'penyebab' => 'required|string|max:1000',
            'kriteria' => 'required|string|max:1000',
            'dampak_terjadi' => 'nullable|string|max:1000',
            'dampak_potensi' => 'nullable|string|max:1000',
            'signifikansi' => 'required|in:Tinggi,Medium,Rendah',
        ]);

        PelaporanIsiLha::create([
            'pelaporan_hasil_audit_id' => $request->pelaporan_hasil_audit_id,
            'nomor_iss' => $request->nomor_iss,
            'permasalahan' => $request->permasalahan,
            'penyebab' => $request->penyebab,
            'kriteria' => $request->kriteria,
            'dampak_terjadi' => $request->dampak_terjadi,
            'dampak_potensi' => $request->dampak_potensi,
            'signifikansi' => $request->signifikansi,
        ]);

        return redirect()->route('audit.isi-lha.index')->with('success', 'Data ISI LHA/LHK berhasil disimpan!');
    }

    public function show($id)
    {
        $data = PelaporanIsiLha::with(['pelaporanHasilAudit', 'approver'])->findOrFail($id);
        return view('audit.pelaporan.isi-lha.show', compact('data'));
    }

    public function edit($id)
    {
        $data = PelaporanIsiLha::findOrFail($id);
        $judulLhaLhk = PelaporanHasilAudit::select('id', 'nomor_lha_lhk', 'nomor_iss')->get();
        return view('audit.pelaporan.isi-lha.edit', compact('data', 'judulLhaLhk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pelaporan_hasil_audit_id' => 'required|exists:pelaporan_hasil_audit,id',
            'permasalahan' => 'required|string|max:1000',
            'penyebab' => 'required|string|max:1000',
            'kriteria' => 'required|string|max:1000',
            'dampak_terjadi' => 'nullable|string|max:1000',
            'dampak_potensi' => 'nullable|string|max:1000',
            'signifikansi' => 'required|in:Tinggi,Medium,Rendah',
        ]);

        $isiLha = PelaporanIsiLha::findOrFail($id);
        $isiLha->update([
            'pelaporan_hasil_audit_id' => $request->pelaporan_hasil_audit_id,
            'nomor_iss' => $request->nomor_iss,
            'permasalahan' => $request->permasalahan,
            'penyebab' => $request->penyebab,
            'kriteria' => $request->kriteria,
            'dampak_terjadi' => $request->dampak_terjadi,
            'dampak_potensi' => $request->dampak_potensi,
            'signifikansi' => $request->signifikansi,
        ]);

        return redirect()->route('audit.isi-lha.index')->with('success', 'Data ISI LHA/LHK berhasil diupdate!');
    }

    public function destroy($id)
    {
        $isiLha = PelaporanIsiLha::findOrFail($id);
        $isiLha->delete();

        return redirect()->route('audit.isi-lha.index')->with('success', 'Data ISI LHA/LHK berhasil dihapus!');
    }

    public function getNomorIss($id)
    {
        $pelaporan = PelaporanHasilAudit::find($id);
        return response()->json(['nomor_iss' => $pelaporan ? $pelaporan->nomor_iss : '']);
    }

    public function approval(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approve,reject'
        ]);

        $isiLha = PelaporanIsiLha::findOrFail($id);
        
        if ($request->action === 'approve') {
            $isiLha->update([
                'status_approval' => 'approved',
                'approver_id' => auth()->id(),
                'approved_at' => now()
            ]);
            $message = 'Data ISI LHA/LHK berhasil diapprove!';
        } else {
            $isiLha->update([
                'status_approval' => 'rejected',
                'approver_id' => auth()->id(),
                'approved_at' => now()
            ]);
            $message = 'Data ISI LHA/LHK berhasil direject!';
        }

        return redirect()->route('audit.isi-lha.index')->with('success', $message);
    }
} 