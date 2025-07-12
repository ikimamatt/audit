<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EntryMeeting;
use App\Models\MasterData\MasterAuditee;
use Illuminate\Support\Facades\Storage;

class EntryMeetingController extends Controller
{
    public function index()
    {
        $data = EntryMeeting::with('auditee')->get();
        return view('audit.entry-meeting.index', compact('data'));
    }

    public function create()
    {
        $auditees = MasterAuditee::all();
        return view('audit.entry-meeting.create', compact('auditees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'auditee_id' => 'required|exists:master_auditee,id',
            'file_undangan' => 'required|file',
            'file_absensi' => 'required|file',
        ]);
        $undanganPath = $request->file('file_undangan')->store('entry_meeting', 'public');
        $absensiPath = $request->file('file_absensi')->store('entry_meeting', 'public');
        EntryMeeting::create([
            'tanggal' => $request->tanggal,
            'auditee_id' => $request->auditee_id,
            'file_undangan' => $undanganPath,
            'file_absensi' => $absensiPath,
        ]);
        return redirect()->route('audit.entry-meeting.index')->with('success', 'Entry Meeting berhasil disimpan!');
    }

    public function edit($id)
    {
        $item = EntryMeeting::findOrFail($id);
        $auditees = MasterAuditee::all();
        return view('audit.entry-meeting.edit', compact('item', 'auditees'));
    }

    public function update(Request $request, $id)
    {
        $item = EntryMeeting::findOrFail($id);
        $request->validate([
            'tanggal' => 'required|date',
            'auditee_id' => 'required|exists:master_auditee,id',
            'file_undangan' => 'nullable|file',
            'file_absensi' => 'nullable|file',
        ]);
        $data = [
            'tanggal' => $request->tanggal,
            'auditee_id' => $request->auditee_id,
        ];
        if ($request->hasFile('file_undangan')) {
            $data['file_undangan'] = $request->file('file_undangan')->store('entry_meeting', 'public');
        }
        if ($request->hasFile('file_absensi')) {
            $data['file_absensi'] = $request->file('file_absensi')->store('entry_meeting', 'public');
        }
        $item->update($data);
        return redirect()->route('audit.entry-meeting.index')->with('success', 'Entry Meeting berhasil diupdate!');
    }

    public function destroy($id)
    {
        $item = EntryMeeting::findOrFail($id);
        $item->delete();
        return redirect()->route('audit.entry-meeting.index')->with('success', 'Entry Meeting berhasil dihapus!');
    }

    public function approval($id, Request $request)
    {
        $item = EntryMeeting::findOrFail($id);
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
        return redirect()->back()->with('success', 'Status Entry Meeting berhasil diubah!');
    }
} 