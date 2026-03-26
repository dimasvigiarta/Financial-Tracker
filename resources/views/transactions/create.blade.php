<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catat Transaksi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #f8fafc; min-height: 100vh;">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
                
                <div class="px-8 py-6 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-xl font-bold text-gray-800">Form Catat Data</h3>
                    <p class="text-sm text-gray-500 mt-1">Transaksi akan otomatis difilter sesuai kategori.</p>
                </div>

                <div class="p-8">
                    @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-md">
                        <strong class="font-bold">Gagal Menyimpan:</strong> {{ $errors->first() }}
                    </div>
                    @endif

                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Tanggal</label>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-gray-800 font-medium" required>
                            </div>

                            <div>
                                <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Jenis</label>
                                <select name="type" id="type_select" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-gray-800 font-medium">
                                    <option value="expense">🔴 Pengeluaran</option>
                                    <option value="income">🟢 Pemasukan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Kategori</label>
                            <select name="category_id" id="category_select" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-gray-800 font-medium">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" data-type="{{ $category->type }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-400 italic mt-1 ml-1">*Kategori muncul sesuai jenis transaksi</p>
                        </div>

                        <div class="mb-2">
                            <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Nominal Uang</label>
                            <div class="flex rounded-lg shadow-sm">
                                <span class="inline-flex items-center px-5 py-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-100 text-gray-600 font-bold text-lg">Rp</span>
                                <input type="number" name="amount" class="flex-1 block w-full rounded-none rounded-r-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-lg font-bold text-gray-800" placeholder="0" required>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 italic mb-6 ml-1">*Minimal Rp 500</p>

                        <div class="mb-8">
                            <label class="block font-bold text-sm text-gray-700 mb-2 ml-1">Keterangan</label>
                            <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 pl-5 text-gray-800 font-medium" placeholder="Contoh: Beli Makan..." required></textarea>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                            <a href="{{ route('transactions.index') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900 px-4 py-2">Batal</a>
                            <button type="submit" style="background-color: #2563eb; color: white; padding: 10px 24px; border-radius: 8px; font-weight: 700; font-size: 15px; border: none; cursor: pointer;">
                                Simpan Data
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
            
            // Ambil semua opsi di dalam dropdown kategori
            const allOptions = Array.from(categorySelect.querySelectorAll('option'));

            function filterCategories() {
                const selectedType = typeSelect.value; // 'income' atau 'expense'
                
                // Reset pilihan biar tidak nyangkut
                categorySelect.value = "";

                // Sembunyikan semua opsi dulu, kecuali yang "-- Pilih Kategori --"
                allOptions.forEach(option => {
                    if (option.value === "") {
                        option.style.display = 'block'; 
                        return;
                    }

                    // Cek tipe kategori (data-type)
                    const categoryType = option.getAttribute('data-type');

                    // Kalau tipenya sama dengan yang dipilih, atau kalau kategori itu belum punya tipe (data lama)
                    if (categoryType === selectedType) {
                        option.style.display = 'block'; // Tampilkan
                    } else {
                        option.style.display = 'none';  // Sembunyikan
                    }
                });
            }

            // Jalankan fungsi saat user mengubah Pemasukan/Pengeluaran
            typeSelect.addEventListener('change', filterCategories);

            // Jalankan sekali saat halaman pertama kali dibuka
            filterCategories();
        });
    </script>

</x-app-layout>