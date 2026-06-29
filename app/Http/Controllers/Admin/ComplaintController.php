<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\ComplaintComment;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::with('category');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                    ->orWhere('complainant_name', 'like', "%{$request->search}%")
                    ->orWhere('location', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $complaints = $query->latest()->paginate(15);
        $categories = Category::all();

        return view('admin.complaints.index', compact('complaints', 'categories'));
    }

    public function show(Complaint $complaint)
    {
        $complaint->load('category', 'comments.user');
        return view('admin.complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint)
    {
        $categories = Category::all();
        return view('admin.complaints.edit', compact('complaint', 'categories'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'status' => 'required|in:submitted,verified,in_progress,resolved,rejected',
            'priority' => 'required|in:low,medium,high,urgent',
            'category_id' => 'required|exists:categories,id',
            'admin_note' => 'nullable|string',
        ]);

        $complaint->update($validated);

        return redirect()
            ->route('admin.complaints.show', $complaint)
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return redirect()
            ->route('admin.complaints.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }

    public function addComment(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
        ]);

        $complaint->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
