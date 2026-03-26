<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction; // <--- PENTING: Biar kenal Database Transaksi
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Halaman Awal: Langsung arahkan ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// === BAGIAN INI YANG TADINYA KOSONG ===
// Sekarang kita isi dengan logika hitung saldo
Route::get('/dashboard', function () {
    $userId = Auth::id();
    
    // 1. Hitung Pemasukan (Income)
    $income = Transaction::where('user_id', $userId)->where('type', 'income')->sum('amount');
    
    // 2. Hitung Pengeluaran (Expense)
    $expense = Transaction::where('user_id', $userId)->where('type', 'expense')->sum('amount');
    
    // 3. Hitung Sisa Saldo
    $balance = $income - $expense;
    
    // Kirim data ($income, $expense, $balance) ke tampilan dashboard
    return view('dashboard', compact('income', 'expense', 'balance'));

})->middleware(['auth', 'verified'])->name('dashboard');
// ======================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Aplikasi Keuangan
    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', TransactionController::class);
});

require __DIR__.'/auth.php';