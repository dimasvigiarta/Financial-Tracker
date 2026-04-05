<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            {{-- Tombol Kembali --}}
            <a href="{{ route('categories.index') }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-extrabold text-xl text-slate-800 leading-tight tracking-tight">
                {{ __('Edit Kategori') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm rounded-[2rem] border border-slate-200">
                
                {{-- Form Header --}}
                <div class="px-6 py-6 sm:px-10 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-tight">Perbarui Informasi</h3>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">Sesuaikan nama atau jenis kategori keuangan Anda.</p>
                </div>

                <div class="p-6 sm:p-10">
                    {{-- Alert Error --}}
                    @if ($errors->any())
                    <div class="mb-8 bg-rose-50 border-l-4 border-rose-500 text-rose-700 p-4 rounded-xl flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm font-bold uppercase tracking-tight">{{ $errors->first() }}</p>
                    </div>
                    @endif

                    <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')
                        
                        {{-- Edit Jenis --}}
                        <div>
                            <label class="block font-black text-[11px] uppercase tracking-widest text-slate-400 mb-3 ml-1">Jenis Kategori</label>
                            <select name="type" class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-4 text-slate-800 font-bold transition-all appearance-none">
                                <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>PENGELUARAN (OUTFLOW)</option>
                                <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>PEMASUKAN (INFLOW)</option>
                            </select>
                        </div>

                        {{-- Edit Nama --}}
                        <div>
                            <label class="block font-black text-[11px] uppercase tracking-widest text-slate-400 mb-3 ml-1">Nama Label</label>
                            <input type="text" name="name" value="{{ $category->name }}" 
                                   class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-4 text-slate-800 font-bold transition-all uppercase" 
                                   required>
                        </div>

                        {{-- Warning Box --}}
                        <div class="bg-amber-50 rounded-2xl p-4 border border-amber-100 flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="text-[10px] font-bold text-amber-700 leading-relaxed uppercase tracking-tight">
                                Catatan: Perubahan nama atau jenis kategori akan langsung diaplikasikan pada semua riwayat transaksi yang menggunakan kategori ini.
                            </p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-100">
                            <a href="{{ route('categories.index') }}" 
                               class="w-full sm:w-auto text-center text-xs font-black text-slate-400 hover:text-slate-600 px-6 py-4 transition-colors uppercase tracking-widest">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest transition-all shadow-xl shadow-indigo-100 active:scale-95">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>