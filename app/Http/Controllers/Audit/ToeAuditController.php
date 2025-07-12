<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ToeAudit;
use App\Models\Audit\PerencanaanAudit;
use App\Models\ToeEvaluasi;
use App\Models\TodBpmAudit;

class ToeAuditController extends Controller
{
    public function index()
    {
        $data = ToeAudit::with(['perencanaanAudit', 'evaluasi'])->get();
        return view('audit.toe.index', compact('data'));
    }

    public function create()
    {
        $suratTugas = PerencanaanAudit::all();
        $bpmList = TodBpmAudit::all();
        return view('audit.toe.create', compact('suratTugas', 'bpmList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'perencanaan_audit_id' => 'required|exists:perencanaan_audit,id',
            'judul_bpm' => 'required|string',
            'pengendalian_eksisting' => 'required|string',
            'hasil_evaluasi' => 'required|array|min:1',
            'hasil_evaluasi.*' => 'required|string',
        ]);
        $toe = ToeAudit::create([
            'perencanaan_audit_id' => $request->perencanaan_audit_id,
            'judul_bpm' => $request->judul_bpm,
            'pengendalian_eksisting' => $request->pengendalian_eksisting,
        ]);
        foreach ($request->hasil_evaluasi as $hasil) {
            ToeEvaluasi::create([
                'toe_audit_id' => $toe->id,
                'hasil_evaluasi' => $hasil,
            ]);
        }
        return redirect()->route('audit.toe.index')->with('success', 'TOE dan hasil evaluasi berhasil disimpan!');
    }

    public function show($id)
    {
        $item = ToeAudit::with(['perencanaanAudit', 'evaluasi'])->findOrFail($id);
        return view('audit.toe.show', compact('item'));
    }

    public function edit($id)
    {
        $item = ToeAudit::with('perencanaanAudit')->findOrFail($id);
        $suratTugas = PerencanaanAudit::all();
        $bpmList = TodBpmAudit::all();
        return view('audit.toe.edit', compact('item', 'suratTugas', 'bpmList'));
    }

    public function update(Request $request, $id)
    {
        $item = ToeAudit::findOrFail($id);
        $request->validate([
            'perencanaan_audit_id' => 'required|exists:perencanaan_audit,id',
            'judul_bpm' => 'required|string',
            'pengendalian_eksisting' => 'required|string',
        ]);
        $data = [
            'perencanaan_audit_id' => $request->perencanaan_audit_id,
            'judul_bpm' => $request->judul_bpm,
            'pengendalian_eksisting' => $request->pengendalian_eksisting,
        ];
        $item->update($data);
        return redirect()->route('audit.toe.index')->with('success', 'Data TOE berhasil diupdate!');
    }

    public function destroy($id)
    {
        $item = ToeAudit::findOrFail($id);
        $item->delete();
        return redirect()->route('audit.toe.index')->with('success', 'Data TOE berhasil dihapus!');
    }

    public function approval($id, Request $request)
    {
        $item = ToeAudit::findOrFail($id);
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
        return redirect()->back()->with('success', 'Status TOE berhasil diubah!');
    }
} 