<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

// Route untuk Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Route yang memerlukan Auth (Sudah Login)
Route::middleware(['auth'])->group(function () {
    // Halaman Utama / Dashboard (Mengonsumsi API /api/stats)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route Khusus Admin (Role: admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class)->except(['show']);
});

// Route untuk Admin dan Petugas (Role: admin, petugas)
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    
    // Tambahkan route report di sini (wajib di atas Route::resource('loans', ...))
    Route::get('/loans/report', [LoanController::class, 'report'])->name('loans.report');
    Route::resource('loans', LoanController::class);

    Route::patch('/loans/{id}/kembalikan', [LoanController::class, 'kembalikan'])
        ->name('loans.kembalikan');
});

Route::prefix('admin')->group(function () {
    Route::get('/info', function () {
        return 'Halaman Admin Info';
    });
});