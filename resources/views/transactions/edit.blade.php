<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #f8fafc; min-height: 100vh;">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
                
                <div class="px-8 py-6 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-xl font-bold text-gray-800">Form Edit Data</h3>
                    <p class="text-sm text-gray-500 mt-1">Silakan perbarui data transaksi di bawah ini.</p>
                </div>

                <div class="p-8">

                    @if ($errors->any())
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-md">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <strong class="font-bold">Gagal Menyimpan:</strong>
                                <span class="block">{{ $errors->first() }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('transactions.update', $transaction) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Tanggal</label>
                                <input type="date" name="date" value="{{ $transaction->date }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-gray-800 font-medium"
                                       required>
                            </div>
                            <div>
                                <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Jenis</label>
                                <select name="type" id="type_select" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-gray-800 font-medium">
                                    <option value="expense" {{ $transaction->type == 'expense' ? 'selected' : '' }}>🔴 Pengeluaran</option>
                                    <option value="income" {{ $transaction->type == 'income' ? 'selected' : '' }}>🟢 Pemasukan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Kategori</label>
                            <select name="category_id" id="category_select" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-gray-800 font-medium">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            data-type="{{ $category->type }}"
                                            {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Nominal Uang</label>
                            <div class="flex rounded-lg shadow-sm">
                                <span class="inline-flex items-center px-5 py-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-100 text-gray-600 font-bold text-lg">
                                    Rp
                                </span>
                                <input type="number" name="amount" value="{{ $transaction->amount }}"
                                       class="flex-1 block w-full rounded-none rounded-r-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-lg font-bold text-gray-800"
                                       placeholder="0" required>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 italic mb-6 ml-1">*Minimal Rp 500</p>

                        <div class="mb-8">
                            <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Keterangan</label>
                            <textarea name="description" rows="3"
                                      class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-gray-800 font-medium"
                                      required>{{ $transaction->description }}</textarea>
                        </div>

                        <div class="mb-8 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 p-4 rounded-r-md">
                            <div class="flex items-start">
                                <svg class="h-5 w-5 text-yellow-400 mr-2 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium">
                                        <strong>Perhatian:</strong> Mohon cek kembali nominal dan tanggal sebelum menyimpan.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                            <a href="{{ route('transactions.index') }}" 
                               class="text-sm font-bold text-gray-600 hover:text-gray-900 px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    style="background-color: #2563eb; color: white; padding: 10px 24px; border-radius: 8px; font-weight: 700; font-size: 15px; border: none; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type_select');
            const categorySelect = document.getElementById('category_select');
            const allOptions = Array.from(categorySelect.querySelectorAll('option'));

            function filterCategories() {
                const selectedType = typeSelect.value; // 'income' atau 'expense'

                allOptions.forEach(option => {
                    // Ambil tipe dari kategori tersebut
                    const categoryType = option.getAttribute('data-type');

                    // Tampilkan jika tipenya cocok, ATAU jika kategori itu tidak punya tipe (biar aman)
                    if (categoryType === selectedType) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });

                // Pastikan nilai yang terpilih valid (kalau hidden, reset)
                const currentSelected = categorySelect.options[categorySelect.selectedIndex];
                if (currentSelected && currentSelected.style.display === 'none') {
                    categorySelect.value = ""; // Reset jika pilihan saat ini jadi tersembunyi
                }
            }

            // Jalankan saat user mengubah Pemasukan/Pengeluaran
            typeSelect.addEventListener('change', function() {
                filterCategories();
                categorySelect.value = ""; // Reset pilihan kategori saat ganti jenis
            });

            // JALANKAN LANGSUNG SAAT HALAMAN DIBUKA
            // Ini penting biar pas edit, kategori yang salah langsung hilang
            filterCategories();
        });
    </script>

</x-app-layout>