<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('transactions.index') }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-extrabold text-xl text-slate-800 leading-tight tracking-tight">
                {{ __('Catat Transaksi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm rounded-[2rem] border border-slate-200">
                
                {{-- Form Header --}}
                <div class="px-6 py-6 sm:px-10 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-tight">Detail Transaksi</h3>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">Lengkapi data di bawah untuk mencatat arus kas baru.</p>
                </div>

                <div class="p-6 sm:p-10">
                    {{-- Alert Error --}}
                    @if ($errors->any())
                    <div class="mb-8 bg-rose-50 border-l-4 border-rose-500 text-rose-700 p-4 rounded-xl flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm font-bold">{{ $errors->first() }}</p>
                    </div>
                    @endif

                    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Input Tanggal --}}
                            <div>
                                <label class="block font-black text-[11px] uppercase tracking-widest text-slate-400 mb-2 ml-1">Tanggal</label>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}"
                                       class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-4 text-slate-800 font-bold transition-all" required>
                            </div>

                            {{-- Input Jenis --}}
                            <div>
                                <label class="block font-black text-[11px] uppercase tracking-widest text-slate-400 mb-2 ml-1">Tipe Transaksi</label>
                                <select name="type" id="type_select" 
                                        class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-4 text-slate-800 font-bold transition-all">
                                    <option value="expense">PENGELUARAN (Keluaran)</option>
                                    <option value="income">PEMASUKAN (Masuk)</option>
                                </select>
                            </div>
                        </div>

                        {{-- Input Kategori --}}
                        <div>
                            <label class="block font-black text-[11px] uppercase tracking-widest text-slate-400 mb-2 ml-1">Kategori Keuangan</label>
                            <div class="relative">
                                <select name="category_id" id="category_select" 
                                        class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-4 text-slate-800 font-bold appearance-none transition-all">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" data-type="{{ $category->type }}">
                                            {{ strtoupper($category->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Input Nominal --}}
                        <div>
                            <label class="block font-black text-[11px] uppercase tracking-widest text-slate-400 mb-2 ml-1">Jumlah Nominal (IDR)</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-5 text-slate-400 font-black text-lg">Rp</span>
                                <input type="number" name="amount" 
                                       class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-5 pl-14 pr-5 text-2xl font-black text-slate-800 placeholder-slate-300 transition-all" 
                                       placeholder="0" required min="500">
                            </div>
                        </div>

                        {{-- Input Keterangan --}}
                        <div>
                            <label class="block font-black text-[11px] uppercase tracking-widest text-slate-400 mb-2 ml-1">Catatan / Keterangan</label>
                            <textarea name="description" rows="3" 
                                      class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-4 text-slate-800 font-bold placeholder-slate-300 transition-all" 
                                      placeholder="Contoh: Belanja bulanan di supermarket..." required></textarea>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-8 border-t border-slate-100 mt-4">
                            <a href="{{ route('transactions.index') }}" 
                               class="w-full sm:w-auto text-center text-sm font-black text-slate-400 hover:text-slate-600 px-6 py-4 transition-colors uppercase tracking-widest">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="w-full sm:w-auto bg-slate-900 hover:bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest transition-all shadow-xl shadow-slate-200 active:scale-95">
                                Simpan Transaksi
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
                const selectedType = typeSelect.value;
                categorySelect.value = "";

                allOptions.forEach(option => {
                    if (option.value === "") {
                        option.style.display = 'block'; 
                        return;
                    }
                    const categoryType = option.getAttribute('data-type');
                    option.style.display = (categoryType === selectedType) ? 'block' : 'none';
                });
            }

            typeSelect.addEventListener('change', filterCategories);
            filterCategories();
        });
    </script>
</x-app-layout>