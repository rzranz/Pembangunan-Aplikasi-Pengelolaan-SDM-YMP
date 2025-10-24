<?php

use App\Http\Controllers\PublicDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicDashboardController::class, 'index'])->name('public.index');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'anggota') {
        return redirect()->route('portfolio.index');
    }
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('members', MemberController::class);
        Route::resource('categories', CategoryController::class)->except(['show']);
    });

Route::middleware(['auth', 'verified'])->group(function () {

    // Halaman utama portfolio anggota (statik)
    Route::get('/portfolio', [ProfileManagementController::class, 'index'])->name('portfolio.index');

    // Halaman kelola profil (statik)
    Route::get('/portfolio/manage', [ProfileManagementController::class, 'manage'])->name('portfolio.manage');

    // Simpan data baru (POST)
    Route::post('/portfolio', [ProfileManagementController::class, 'storePortfolio'])->name('portfolio.store');
    Route::post('/experience', [ProfileManagementController::class, 'storeExperience'])->name('experience.store');
    Route::post('/education', [ProfileManagementController::class, 'storeEducation'])->name('education.store');
    Route::post('/certification', [ProfileManagementController::class, 'storeCertification'])->name('certification.store');

    // Hapus data (DELETE)
    Route::delete('/portfolio/{portfolio}', [ProfileManagementController::class, 'destroyPortfolio'])->name('portfolio.destroy');
    Route::delete('/experience/{experience}', [ProfileManagementController::class, 'destroyExperience'])->name('experience.destroy');
    Route::delete('/education/{education}', [ProfileManagementController::class, 'destroyEducation'])->name('education.destroy');
    Route::delete('/certification/{certification}', [ProfileManagementController::class, 'destroyCertification'])->name('certification.destroy');

    // Update data (PATCH / POST)
    Route::patch('/bio', [ProfileManagementController::class, 'updateBio'])->name('bio.update');
    Route::post('/profile-picture', [ProfileManagementController::class, 'updateProfilePicture'])->name('profile_picture.update');
});

Route::get('/portfolio/{user}', [ProfileManagementController::class, 'show'])->name('public.portfolio.show');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
