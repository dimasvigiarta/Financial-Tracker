<x-app-layout>
    <div class="py-6 sm:py-8 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header: Sambutan Premium --}}
            <div class="mb-6 flex flex-col justify-center">
                <p class="text-sm font-medium text-slate-500 mb-1">Selamat datang kembali,</p>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ Auth::user()->name }}
                </h2>
            </div>
            
            {{-- Kartu Saldo Utama (Desain Premium Card ala Mobile Banking) --}}
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-black p-6 sm:p-8 rounded-3xl shadow-xl shadow-slate-900/20 relative overflow-hidden mb-5">
                {{-- Ornamen Latar Belakang Kartu --}}
                <div class="absolute top-0 right-0 -mr-8 -mt-8 w-40 h-40 rounded-full bg-white/5 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-32 h-32 rounded-full bg-indigo-500/20 blur-xl"></div>
                <div class="absolute top-4 right-4 text-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 4H3C1.895 4 1 4.895 1 6v12c0 1.105.895 2 2 2h18c1.105 2 2-1.105 2-2V6c0-1.105-.895-2-2-2zM3 6h18v3H3V6zm0 12v-7h18v7H3z"/>
                        <path d="M16 13h3v2h-3z"/>
                    </svg>
                </div>
                
                <div class="relative z-10">
                    <p class="text-slate-400 text-xs sm:text-sm font-semibold tracking-wider uppercase mb-2">Total Saldo Aktif</p>
                    <div class="flex items-baseline gap-2 mb-6">
                        <span class="text-slate-300 text-xl font-bold">Rp</span>
                        <h3 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight">
                            {{ number_format($balance ?? 0, 0, ',', '.') }}
                        </h3>
                    </div>
                </div>
                
                <div class="relative z-10 flex items-center justify-between mt-4 pt-5 border-t border-white/10 text-slate-300 text-xs sm:text-sm">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">Dompet Utama</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-emerald-400 font-medium">Aktif</span>
                    </div>
                </div>
            </div>

            {{-- Grid Pemasukan & Pengeluaran (Side-by-side) --}}
            <div class="grid grid-cols-2 gap-4 sm:gap-6 mb-8">
                
                {{-- Kartu Pemasukan --}}
                <div class="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden group hover:border-emerald-200 transition-all">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-emerald-50 rounded-bl-[100px] -z-0 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-100 flex items-center justify-center mb-4 text-emerald-600 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 5L5 19M5 19V9M5 19h10" />
                            </svg>
                        </div>
                        <p class="text-slate-500 text-xs font-bold tracking-wider uppercase mb-1">Pemasukan</p>
                        <h4 class="text-lg sm:text-xl font-bold text-slate-800">
                            Rp {{ number_format($income ?? 0, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>

                {{-- Kartu Pengeluaran --}}
                <div class="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden group hover:border-rose-200 transition-all">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-rose-50 rounded-bl-[100px] -z-0 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="w-10 h-10 rounded-2xl bg-rose-100 flex items-center justify-center mb-4 text-rose-600 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 19L19 5M19 5v10M19 5H9" />
                            </svg>
                        </div>
                        <p class="text-slate-500 text-xs font-bold tracking-wider uppercase mb-1">Pengeluaran</p>
                        <h4 class="text-lg sm:text-xl font-bold text-slate-800">
                            Rp {{ number_format($expense ?? 0, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>

            </div>

            {{-- Menu Utama / Aksi Cepat (Desain Grid Icon ala App) --}}
            <div class="mb-4">
                <h3 class="font-bold text-slate-800 text-lg px-1">Aksi Cepat</h3>
            </div>
            
            <div class="grid grid-cols-3 gap-3 sm:gap-6">
                
                {{-- Tombol Catat Transaksi --}}
                <a href="{{ route('transactions.create') }}" class="flex flex-col items-center justify-center bg-white p-4 sm:p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 mb-3 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-semibold text-slate-700 text-center">Catat<br>Transaksi</span>
                </a>

                {{-- Tombol Lihat Riwayat --}}
                <a href="{{ route('transactions.index') }}" class="flex flex-col items-center justify-center bg-white p-4 sm:p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-3 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-semibold text-slate-700 text-center">Lihat<br>Riwayat</span>
                </a>

                {{-- Tombol Atur Kategori --}}
                <a href="{{ route('categories.index') }}" class="flex flex-col items-center justify-center bg-white p-4 sm:p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-600 mb-3 group-hover:bg-slate-800 group-hover:text-white transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-semibold text-slate-700 text-center">Atur<br>Kategori</span>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>