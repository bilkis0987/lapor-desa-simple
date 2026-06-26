<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
    Route::get('/buat', [ComplaintController::class, 'create'])->name('buat');
    Route::post('/buat', [ComplaintController::class, 'store'])->name('simpan');
    Route::get('/lacak', [ComplaintController::class, 'track'])->name('lacak');
    Route::get('/{complaint}', [ComplaintController::class, 'show'])->name('detail');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/complaints', [AdminComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/{complaint}', [AdminComplaintController::class, 'show'])->name('complaints.show');
    Route::get('/complaints/{complaint}/edit', [AdminComplaintController::class, 'edit'])->name('complaints.edit');
    Route::put('/complaints/{complaint}', [AdminComplaintController::class, 'update'])->name('complaints.update');
    Route::delete('/complaints/{complaint}', [AdminComplaintController::class, 'destroy'])->name('complaints.destroy');
    Route::post('/complaints/{complaint}/comments', [AdminComplaintController::class, 'addComment'])->name('complaints.comments');

    Route::resource('categories', CategoryController::class)->except('show');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
