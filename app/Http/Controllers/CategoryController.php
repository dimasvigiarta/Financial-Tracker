<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // 1. Tampilkan semua kategori MILIK SAYA SAJA
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('categories.index', compact('categories'));
    }

    // 2. Tampilkan formulir tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    // 3. Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense', 
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // 4. Tampilkan formulir edit
    public function edit(Category $category)
    {
        if ($category->user_id != Auth::id()) {
            abort(403);
        }
        return view('categories.edit', compact('category'));
    }

    // 5. UPDATE (INI BAGIAN PENTING YANG DIPERBAIKI)
    public function update(Request $request, Category $category)
    {
        // Keamanan
        if ($category->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
        ]);

        // 1. Update Data Kategori (Nama & Jenis)
        $category->update([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        // 2. [BARIS SAKTI] Update juga SEMUA Transaksi yang punya kategori ini
        // Agar warna merah/hijau di riwayat ikut berubah otomatis
        $category->transactions()->update(['type' => $request->type]);

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori dan seluruh transaksi terkait berhasil diperbarui!');
    }

    // 6. Hapus kategori
    public function destroy(Category $category)
    {
        if ($category->user_id != Auth::id()) {
            abort(403);
        }

        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil dihapus!');
    }
}