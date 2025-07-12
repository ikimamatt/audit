<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use App\Models\WalkthroughAudit;
use App\Models\Audit\PerencanaanAudit;
use Illuminate\Http\Request;

class WalkthroughAuditController extends Controller
{
    public function index()
    {
        $data = WalkthroughAudit::with('perencanaanAudit')->get();
        return view('audit.walkthrough.index', compact('data'));
    }

    public function create()
    {
        $suratTugas = PerencanaanAudit::all();
        return view('audit.walkthrough.create', compact('suratTugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'perencanaan_audit_id' => 'required|exists:perencanaan_audit,id',
            'tanggal_walkthrough' => 'required|date',
            'auditee_nama' => 'required|string',
            'hasil_walkthrough' => 'required|string',
        ]);
        WalkthroughAudit::create($request->all());
        return redirect()->route('audit.walkthrough.index')->with('success', 'Hasil walkthrough berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = WalkthroughAudit::findOrFail($id);
        $suratTugas = PerencanaanAudit::all();
        return view('audit.walkthrough.edit', compact('item', 'suratTugas'));
    }

    public function update(Request $request, $id)
    {
        $item = WalkthroughAudit::findOrFail($id);
        $request->validate([
            'perencanaan_audit_id' => 'required|exists:perencanaan_audit,id',
            'tanggal_walkthrough' => 'required|date',
            'auditee_nama' => 'required|string',
            'hasil_walkthrough' => 'required|string',
        ]);
        $item->update($request->all());
        return redirect()->route('audit.walkthrough.index')->with('success', 'Hasil walkthrough berhasil diupdate!');
    }

    public function destroy($id)
    {
        $item = WalkthroughAudit::findOrFail($id);
        $item->delete();
        return redirect()->route('audit.walkthrough.index')->with('success', 'Hasil walkthrough berhasil dihapus!');
    }

    public function approval($id, Request $request)
    {
        $item = WalkthroughAudit::findOrFail($id);
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
        return redirect()->back()->with('success', 'Status walkthrough berhasil diubah!');
    }
}
