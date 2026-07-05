<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;

class LandingController extends Controller
{
    public function index()
    {
        $totalComplaints = Complaint::count();
        $resolvedComplaints = Complaint::where('status', 'resolved')->count();
        $inProgressComplaints = Complaint::where('status', 'in_progress')->count();
        $categories = Category::withCount('complaints')->get();
        $recentComplaints = Complaint::with('category')
            ->latest()
            ->take(6)
            ->get();

        return view('landing', compact(
            'totalComplaints', 'resolvedComplaints', 'inProgressComplaints',
            'categories', 'recentComplaints'
        ));
    }
}

// Stats: complaint counts by category
// BUGFIX: Sanitize search input