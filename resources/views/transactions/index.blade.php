<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl sm:text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Data Keuangan</h3>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium">Rekap pengeluaran dan pemasukan Anda.</p>
                </div>
                <a href="{{ route('transactions.create') }}" 
                   class="w-full sm:w-auto flex justify-center items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-bold text-sm transition-all shadow-lg shadow-indigo-100 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Transaksi Baru
                </a>
            </div>

            {{-- --- TAMPILAN DESKTOP (Muncul di layar md ke atas) --- --}}
            <div class="hidden md:block bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tanggal</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Keterangan</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Kategori</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Jumlah</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($transactions as $transaction)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="px-6 py-4 text-sm font-semibold text-slate-500 uppercase tracking-tighter">
                                {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-slate-800">{{ $transaction->description }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-slate-100 text-slate-600 border border-slate-200">
                                    {{ $transaction->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-sm font-black tracking-tight {{ $transaction->type == 'income' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $transaction->type == 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('transactions.edit', $transaction) }}" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></a>
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?');">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-slate-400 hover:text-rose-600 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        {{-- Empty State Desktop --}}
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- --- TAMPILAN MOBILE (Muncul di layar < md) --- --}}
            <div class="block md:hidden space-y-3">
                @forelse ($transactions as $transaction)
                <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm active:bg-slate-50 transition-colors">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</p>
                            <h4 class="text-sm font-bold text-slate-800 leading-tight">{{ $transaction->description }}</h4>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-black tracking-tight {{ $transaction->type == 'income' ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $transaction->type == 'income' ? '+' : '-' }} Rp{{ number_format($transaction->amount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-4 pt-3 border-t border-slate-50">
                        <span class="px-2 py-0.5 rounded-lg text-[9px] font-extrabold uppercase tracking-wider bg-slate-100 text-slate-500 border border-slate-200">
                            {{ $transaction->category->name }}
                        </span>
                        <div class="flex gap-4">
                            <a href="{{ route('transactions.edit', $transaction) }}" class="text-xs font-bold text-indigo-600">Edit</a>
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-xs font-bold text-rose-600 uppercase">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300">
                    <p class="text-slate-400 text-sm font-medium">Belum ada transaksi.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>