<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $totalComplaints = Complaint::count();
        $submitted = Complaint::where('status', 'submitted')->count();
        $verified = Complaint::where('status', 'verified')->count();
        $inProgress = Complaint::where('status', 'in_progress')->count();
        $resolved = Complaint::where('status', 'resolved')->count();
        $rejected = Complaint::where('status', 'rejected')->count();

        $recentComplaints = Complaint::with('category')
            ->latest()
            ->take(10)
            ->get();

        $complaintsByCategory = Category::withCount('complaints')
            ->get()
            ->pluck('complaints_count', 'name');

        $complaintsByMonth = Complaint::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month');

        return view('admin.dashboard', compact(
            'totalComplaints', 'submitted', 'verified', 'inProgress',
            'resolved', 'rejected', 'recentComplaints',
            'complaintsByCategory', 'complaintsByMonth'
        ));
    }
}

// TODO: Add weekly stats query