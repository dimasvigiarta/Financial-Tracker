<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen"> {{-- Warna background yang lebih terang dan bersih --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Bagian Header: Sambutan --}}
            <div class="mb-8 px-4 sm:px-0">
                <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">
                    Halo, {{ Auth::user()->name }}! 👋
                </h2>
                <p class="text-gray-500 text-base mt-1">Berikut ringkasan keuanganmu hari ini.</p>
            </div>
            
            <div class="px-4 sm:px-0">
                <h3 class="font-bold text-gray-700 text-lg mb-4">Ringkasan Keuangan</h3>
            </div>
            
            {{-- Grid Kartu Ringkasan --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10 px-4 sm:px-0">
                
                {{-- 🟦 Kartu SISA SALDO (Desain Premium/Gradient) --}}
                <div class="p-6 rounded-2xl text-white shadow-xl lg:col-span-1" 
                     style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); position: relative; overflow: hidden; box-shadow: 0 15px 35px -10px rgba(37, 99, 235, 0.5);">
                    
                    {{-- Efek Bulatan Cahaya --}}
                    <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full"></div>
                    
                    <div class="relative z-10">
                        <p class="text-sm font-semibold opacity-80 uppercase tracking-widest">SISA SALDO</p>
                        <h3 class="text-4xl font-extrabold mt-3 mb-4">
                            Rp {{ number_format($balance ?? 0, 0, ',', '.') }}
                        </h3>
                        <div class="flex items-center gap-2 text-sm opacity-90">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span>Dompet Utama</span>
                        </div>
                    </div>
                </div>

                {{-- 🟢 Kartu PEMASUKAN --}}
                <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-emerald-500 flex flex-col justify-center transition hover:shadow-xl">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pemasukan Total</p>
                            <h3 class="text-3xl font-extrabold text-emerald-600 mt-2">
                                + Rp {{ number_format($income ?? 0, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="bg-emerald-100 p-3 rounded-xl text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- 🔴 Kartu PENGELUARAN --}}
                <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-red-500 flex flex-col justify-center transition hover:shadow-xl">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pengeluaran Total</p>
                            <h3 class="text-3xl font-extrabold text-red-600 mt-2">
                                - Rp {{ number_format($expense ?? 0, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="bg-red-100 p-3 rounded-xl text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Menu Utama --}}
            <div class="px-4 sm:px-0">
                <h3 class="font-bold text-gray-700 text-lg mb-4">Aksi Cepat</h3>
            </div>
            
            {{-- Kotak Aksi Cepat --}}
            <div class="bg-white p-8 rounded-2xl shadow-xl px-4 sm:px-0">
                <div class="flex justify-start gap-4 md:gap-6 flex-wrap">
                    
                    {{-- ➕ Tombol Catat Transaksi --}}
                    <a href="{{ route('transactions.create') }}" 
                       class="flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 transition duration-300 transform hover:scale-105 shadow-md shadow-blue-500/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Catat Transaksi
                    </a>

                    {{-- 📄 Tombol Lihat Riwayat --}}
                    <a href="{{ route('transactions.index') }}" 
                       class="flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 transform hover:scale-105 shadow-md shadow-indigo-500/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Lihat Riwayat
                    </a>

                    {{-- 🏷️ Tombol Atur Kategori --}}
                    <a href="{{ route('categories.index') }}" 
                       class="flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-white bg-gray-600 hover:bg-gray-700 transition duration-300 transform hover:scale-105 shadow-md shadow-gray-500/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                        </svg>
                        Atur Kategori
                    </a>

                </div>
            </div>

            {{-- Anda dapat menambahkan section lain di sini, seperti Transaksi Terbaru, Grafik, dll. --}}
            {{-- <div class="mt-8 px-4 sm:px-0">
                <h3 class="font-bold text-gray-700 text-lg mb-4">Transaksi Terbaru</h3>
                <div class="bg-white p-6 rounded-2xl shadow-xl">
                    <p class="text-gray-500">... Daftar transaksi atau tabel di sini ...</p>
                </div>
            </div> --}}

        </div>
    </div>
</x-app-layout>