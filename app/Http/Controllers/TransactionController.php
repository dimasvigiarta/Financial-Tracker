<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        // Mengambil data transaksi milik user, diurutkan tanggal terbaru
        // Menggunakan paginate(10) agar halaman rapi
        $transactions = Transaction::where('user_id', Auth::id())
                        ->with('category')
                        ->latest('date')
                        ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    // --- BAGIAN SIMPAN DATA BARU ---
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            // VALIDASI BARU: Wajib angka & Minimal 500
            'amount' => 'required|numeric|min:500', 
            'description' => 'required|string',
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
        ], [
            // Pesan Error Bahasa Indonesia (Opsional)
            'amount.min' => 'Minimal jumlah uang adalah Rp 500!',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'type' => $request->type,
            'date' => $request->date,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function edit(Transaction $transaction)
    {
        // Keamanan: Pastikan user hanya bisa edit data miliknya sendiri
        if ($transaction->user_id != Auth::id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    // --- BAGIAN UPDATE DATA (EDIT) ---
    public function update(Request $request, Transaction $transaction)
    {
        // Keamanan
        if ($transaction->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'category_id' => 'required',
            // VALIDASI BARU: Wajib angka & Minimal 500
            'amount' => 'required|numeric|min:500',
            'description' => 'required|string',
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
        ], [
            'amount.min' => 'Minimal jumlah uang adalah Rp 500!',
        ]);

        $transaction->update([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'type' => $request->type,
            'date' => $request->date,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id != Auth::id()) {
            abort(403);
        }
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi dihapus!');
    }
}