<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/campaigns/{campaign:slug}', [CampaignController::class,'show'])->name('campaigns.show');

Route::post('/campaigns/{campaign}/donate', [DonationController::class, 'store'])->name('donations.store');

// PROTECTED ROUTES (User harus login)
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Management Campaign (CRUD)
    // Route::resource otomatis membuat route untuk index, create, store, edit, update, destroy
    Route::resource('dashboard/campaigns', CampaignController::class)
        ->except(['show']) // Kita tidak butuh 'show' di dashboard karena sudah ada di public
        ->names('dashboard.campaigns'); // Prefix nama route jadi dashboard.campaigns.index, dst.

    // Riwayat Donasi User
    Route::get('/dashboard/donations', [DashboardController::class, 'donations'])->name('dashboard.donations');

    // Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
