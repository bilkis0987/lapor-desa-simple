<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('pengaduan.buat', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'complainant_name' => 'required|string|max:255',
            'complainant_phone' => 'nullable|string|max:20',
            'complainant_email' => 'nullable|email|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('complaints', 'public');
        }

        $validated['status'] = 'submitted';
        $validated['priority'] = 'medium';

        $complaint = Complaint::create($validated);

        return redirect()
            ->route('pengaduan.detail', $complaint->id)
            ->with('success', 'Pengaduan berhasil dikirim. Simpan ID pengaduan untuk melacak status.');
    }

    public function track(Request $request)
    {
        $complaints = collect();

        if ($request->filled('search')) {
            $search = $request->search;
            $complaints = Complaint::with('category')
                ->where('complainant_name', 'like', "%{$search}%")
                ->orWhere('title', 'like', "%{$search}%")
                ->latest()
                ->get();

            if ($complaints->isEmpty()) {
                return back()->with('error', 'Pengaduan tidak ditemukan.')->withInput();
            }

            if ($complaints->count() === 1) {
                return redirect()->route('pengaduan.detail', $complaints->first()->id);
            }
        }

        return view('pengaduan.lacak', compact('complaints'));
    }

    public function show(Complaint $complaint)
    {
        $complaint->load('category', 'comments.user');
        return view('pengaduan.detail', compact('complaint'));
    }
}

// Index method: paginate with search filter
// BUGFIX: Increase max file size to 5MB
// BUGFIX: Add regex phone validation