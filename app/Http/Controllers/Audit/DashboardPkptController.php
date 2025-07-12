<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use App\Models\Models\Audit\JadwalPkptAudit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardPkptController extends Controller
{
    public function index()
    {
        // Fetch approved PKPT data
        $pkptData = JadwalPkptAudit::with('auditee')
                                    ->where('status_approval', 'approved')
                                    ->get();

        $dashboardData = [];
        $months = [];

        // Generate months for the current year
        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create(null, $i, 1)->translatedFormat('M'); // e.g., Jan, Feb
            $months[] = $monthName;
        }

        foreach ($pkptData as $item) {
            $auditeeName = $item->auditee ? $item->auditee->direktorat . ' - ' . $item->auditee->divisi_cabang : '-';
            $jenisAudit = $item->jenis_audit;
            $jumlahAuditor = $item->jumlah_auditor;

            $key = $auditeeName . '|' . $jenisAudit; // Unique key for grouping

            if (!isset($dashboardData[$key])) {
                $dashboardData[$key] = [
                    'auditee' => $auditeeName,
                    'jenis_audit' => $jenisAudit,
                    'jumlah_auditor' => $jumlahAuditor,
                    'schedule' => array_fill_keys($months, []), // Initialize schedule for all months
                ];
            }

            $startDate = Carbon::parse($item->tanggal_mulai);
            $endDate = Carbon::parse($item->tanggal_selesai);

            // Populate months with audit schedule
            foreach ($months as $month) {
                $monthNum = Carbon::parse($month)->month; // Get month number from name

                // Check if the audit period overlaps with the current month
                if (($startDate->month <= $monthNum && $startDate->year <= $endDate->year) &&
                    ($endDate->month >= $monthNum && $endDate->year >= $startDate->year)) {
                    // If the audit spans multiple months, mark all relevant months
                    if ($startDate->month <= $monthNum && $endDate->month >= $monthNum) {
                        $dashboardData[$key]['schedule'][$month][] = $item->id; // Store item ID or a marker
                    }
                }
            }
        }

        // Convert associative array to indexed array for easier iteration in Blade
        $dashboardData = array_values($dashboardData);

        return view('audit.dashboard-pkpt.index', compact('dashboardData', 'months'));
    }
}
