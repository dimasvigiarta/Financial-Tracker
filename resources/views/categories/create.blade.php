<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori Baru') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #f8fafc; min-height: 100vh;">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
                
                <div class="px-8 py-6 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-xl font-bold text-gray-800">Form Kategori</h3>
                    <p class="text-sm text-gray-500 mt-1">Buat kategori baru untuk mengelompokkan transaksi.</p>
                </div>

                <div class="p-8">
                    
                    @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">Gagal Menyimpan!</strong>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Jenis Kategori</label>
                            <select name="type" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-gray-800 font-medium" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="expense">🔴 Pengeluaran</option>
                                <option value="income">🟢 Pemasukan</option>
                            </select>
                        </div>

                        <div class="mb-8">
                            <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Nama Kategori</label>
                            <input type="text" name="name" placeholder="Contoh: Gaji, Bensin, Makan..." 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-gray-800 font-medium" required>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                            <a href="{{ route('categories.index') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900 px-4 py-2">Batal</a>
                            <button type="submit" style="background-color: #2563eb; color: white; padding: 10px 24px; border-radius: 8px; font-weight: 700; font-size: 15px; border: none; cursor: pointer;">
                                Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>