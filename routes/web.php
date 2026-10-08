<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route untuk Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Route yang memerlukan Auth (Sudah Login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman Dashboard (Bisa diakses semua user yang sudah login)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route Khusus Admin (Role: admin)
// Contoh: Manajemen Kategori hanya boleh diakses oleh Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class)->except(['show']);
});

// Route untuk Admin dan Petugas (Role: admin, petugas)
// Manajemen Buku, Anggota, dan Peminjaman (Loan) bisa dikelola Admin & Petugas
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    Route::resource('loans', LoanController::class);

    Route::patch('/loans/{id}/kembalikan', [LoanController::class, 'kembalikan'])
        ->name('loans.kembalikan');
});

Route::prefix('admin')->group(function () {
    Route::get('/info', function () {
        return 'Halaman Admin Info';
    });
});