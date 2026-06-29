<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function exportPdf(Request $request)
    {
        $query = Complaint::with('category');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->from_date));
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->to_date));
        }

        $complaints = $query->latest()->get();
        $title = 'Laporan Pengaduan ' . now()->format('d/m/Y');

        $pdf = Pdf::loadView('admin.reports.pdf', compact('complaints', 'title'));

        return $pdf->download('laporan-pengaduan-' . now()->format('Y-m-d') . '.pdf');
    }
}
