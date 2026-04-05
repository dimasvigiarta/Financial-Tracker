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
                {{ __('Tambah Kategori') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm rounded-[2rem] border border-slate-200">
                
                {{-- Form Header --}}
                <div class="px-6 py-6 sm:px-10 border-b border-slate-100 bg-slate-50/50 text-center sm:text-left">
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-tight">Detail Kategori</h3>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">Buat label baru untuk mengelompokkan arus kas Anda.</p>
                </div>

                <div class="p-6 sm:p-10">
                    {{-- Alert Error --}}
                    @if ($errors->any())
                    <div class="mb-8 bg-rose-50 border-l-4 border-rose-500 text-rose-700 p-4 rounded-xl flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="text-sm font-bold uppercase tracking-tight mb-1">Gagal Menyimpan:</p>
                            <ul class="text-xs font-medium list-disc list-inside opacity-80">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-8">
                        @csrf
                        
                        {{-- Pilih Jenis --}}
                        <div>
                            <label class="block font-black text-[11px] uppercase tracking-widest text-slate-400 mb-3 ml-1">Jenis Peruntukan</label>
                            <div class="grid grid-cols-1 gap-3">
                                <select name="type" class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-4 text-slate-800 font-bold transition-all appearance-none" required>
                                    <option value="">-- Pilih Jenis Kategori --</option>
                                    <option value="expense">PENGELUARAN (OUTFLOW)</option>
                                    <option value="income">PEMASUKAN (INFLOW)</option>
                                </select>
                            </div>
                        </div>

                        {{-- Nama Kategori --}}
                        <div>
                            <label class="block font-black text-[11px] uppercase tracking-widest text-slate-400 mb-3 ml-1">Nama Label Kategori</label>
                            <input type="text" name="name" placeholder="Contoh: Gaji, Belanja, Transportasi..." 
                                   class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-4 text-slate-800 font-bold placeholder-slate-300 transition-all uppercase" 
                                   required>
                        </div>

                        {{-- Info Box --}}
                        <div class="bg-indigo-50 rounded-2xl p-4 border border-indigo-100 flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-[10px] font-bold text-indigo-700 leading-relaxed uppercase tracking-tight">
                                Kategori ini akan muncul secara otomatis pada pilihan saat Anda mencatat transaksi baru sesuai jenisnya.
                            </p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-100">
                            <a href="{{ route('categories.index') }}" 
                               class="w-full sm:w-auto text-center text-xs font-black text-slate-400 hover:text-slate-600 px-6 py-4 transition-colors uppercase tracking-widest">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="w-full sm:w-auto bg-slate-900 hover:bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest transition-all shadow-xl shadow-slate-200 active:scale-95">
                                Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>