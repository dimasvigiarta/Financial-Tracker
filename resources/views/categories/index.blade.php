<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl sm:text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Pengaturan Kategori') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Kategori Keuangan</h3>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium">Kelola label untuk memisahkan jenis transaksi Anda.</p>
                </div>
                <a href="{{ route('categories.create') }}" 
                   class="w-full sm:w-auto flex justify-center items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-indigo-100 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Kategori Baru
                </a>
            </div>

            {{-- --- TAMPILAN DESKTOP --- --}}
            <div class="hidden md:block bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama Kategori</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Tipe</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($categories as $category)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-5">
                                <span class="text-sm font-bold text-slate-700 uppercase tracking-tight">{{ $category->name }}</span>
                            </td>
                            <td class="px-8 py-5">
                                @if($category->type == 'income')
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-100">Pemasukan</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-rose-50 text-rose-600 border border-rose-100">Pengeluaran</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('categories.edit', $category) }}" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?');">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-slate-400 hover:text-rose-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        {{-- Desktop Empty State handled by forelse empty --}}
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- --- TAMPILAN MOBILE --- --}}
            <div class="block md:hidden space-y-4">
                @forelse ($categories as $category)
                <div class="bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $category->name }}</h4>
                            <div class="mt-1">
                                @if($category->type == 'income')
                                    <span class="text-[9px] font-black uppercase tracking-widest text-emerald-600">Pemasukan</span>
                                @else
                                    <span class="text-[9px] font-black uppercase tracking-widest text-rose-600">Pengeluaran</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('categories.edit', $category) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:text-rose-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-16 bg-white rounded-[2rem] border border-dashed border-slate-300">
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Data Kosong</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>