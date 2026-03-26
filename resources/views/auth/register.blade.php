<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Daftar | Uangku</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    
    <style>
        /* BASE CSS (DISALIN DARI LOGIN) */
        .premium-bg {
            /* Gradien Biru Tua Dasar */
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); 
            position: relative; 
            overflow: hidden;
        }

        /* 💡 ESTETIKA ARTISTIK (Background Seni Pencatatan/Keuangan) */
        .premium-bg::before,
        .premium-bg::after {
            content: '';
            position: absolute;
            border-radius: 50%; 
            filter: blur(150px); 
            opacity: 0.6;
            z-index: 0; 
        }
        
        /* Shape 1: Bulatan Besar Kiri Bawah (Mewakili data besar) */
        .premium-bg::before {
            width: 450px;
            height: 450px;
            background: #2563eb; /* Biru Neon */
            bottom: -150px;
            left: -150px;
        }
        
        /* Shape 2: Bulatan Sedang Kanan Atas (Mewakili catatan kecil) */
        .premium-bg::after {
            width: 300px;
            height: 300px;
            background: #3b82f6; /* Biru Cerah */
            top: -50px;
            right: -50px;
        }

        /* CARD GLASSMORPHISM */
        .glass-card {
            background-color: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(12px); 
            border: 1px solid rgba(255, 255, 255, 0.2); 
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5); 
            z-index: 10; 
            position: relative;
            transition: all 0.3s;
        }

        /* 🚀 TOMBOL (Kontras dan Jelas Bentuknya) */
        .gradient-button {
            /* Gradien yang sedikit lebih kontras */
            background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%); 
            /* Bayangan lebih tegas dan gelap untuk definisi bentuk */
            box-shadow: 0 6px 15px rgba(30, 64, 175, 0.7); 
            border: 1px solid rgba(255, 255, 255, 0.2); /* Border putih tipis agar terlihat solid di Glass Card */
            transition: all 0.3s ease-in-out;
        }
        .gradient-button:hover {
            transform: translateY(-2px);
            /* Bayangan sedikit lebih besar saat hover */
            box-shadow: 0 10px 20px rgba(30, 64, 175, 0.9); 
            opacity: 1; 
        }
        
        /* INPUT GLASS */
        .glass-input {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white; 
        }
        .glass-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        .glass-input:focus {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
        }
        
    </style>
</head>
<body class="font-['Inter'] antialiased">

    {{-- Container Utama: Gradien Biru Tua Artistik --}}
    <div class="min-h-screen flex items-center justify-center p-4 premium-bg"> 

        {{-- Kartu Formulir Register: Glassmorphism Mewah --}}
        <div class="w-full max-w-md p-8 sm:p-10 rounded-2xl text-white glass-card">

            {{-- Logo dan Judul --}}
            <div class="mb-8 text-center">
                {{-- Ikon Dompet PREMIUM (Gradien Putih/Perak) --}}
                <svg class="w-16 h-16 mx-auto mb-3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="premiumWalletGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#fef2f2;stop-opacity:1" /> 
                            <stop offset="100%" style="stop-color:#d4d4d4;stop-opacity:1" /> 
                        </linearGradient>
                    </defs>
                    <path d="M19 8H5C3.34 8 2 9.34 2 11V19C2 20.66 3.34 22 5 22H19C20.66 22 22 20.66 22 19V11C22 9.34 20.66 8 19 8ZM19 8C19 6.66 17.66 5 16 5H8C6.34 5 5 6.66 5 8M12 17C13.1 17 14 16.1 14 15C14 13.9 13.1 13 12 13C10.9 13 10 13.9 10 15C10 16.1 10.9 17 12 17Z" fill="url(#premiumWalletGradient)"/>
                    <path d="M4 4H18V6H4V4Z" fill="white"/> 
                </svg>
                <h1 class="text-3xl font-black tracking-wider text-white">UANGKU</h1>
                <p class="text-sm text-white/80 mt-1">Daftar sekarang untuk mulai mencatat keuangan</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- 👤 Bidang Nama --}}
                <div class="mb-5">
                    <label for="name" class="block font-semibold text-sm text-white mb-2">Nama Lengkap</label>
                    <input id="name" 
                           class="w-full rounded-lg shadow-sm py-3 px-4 text-base transition duration-200 glass-input" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="Masukkan nama Anda"
                           required autofocus autocomplete="name" />
                    @error('name')
                        <p class="text-sm text-red-300 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 📧 Bidang Email --}}
                <div class="mb-5">
                    <label for="email" class="block font-semibold text-sm text-white mb-2">Alamat Email</label>
                    <input id="email" 
                           class="w-full rounded-lg shadow-sm py-3 px-4 text-base transition duration-200 glass-input" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="contoh@email.com"
                           required autocomplete="username" />
                    @error('email')
                        <p class="text-sm text-red-300 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 🔑 Bidang Password --}}
                <div class="mb-5">
                    <label for="password" class="block font-semibold text-sm text-white mb-2">Kata Sandi</label>
                    <input id="password" 
                           class="w-full rounded-lg shadow-sm py-3 px-4 text-base transition duration-200 glass-input"
                           type="password"
                           name="password"
                           placeholder="Buat kata sandi minimal 8 karakter"
                           required autocomplete="new-password" />
                    @error('password')
                        <p class="text-sm text-red-300 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- 🔑 Bidang Konfirmasi Password --}}
                <div class="mb-5">
                    <label for="password_confirmation" class="block font-semibold text-sm text-white mb-2">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" 
                           class="w-full rounded-lg shadow-sm py-3 px-4 text-base transition duration-200 glass-input"
                           type="password"
                           name="password_confirmation"
                           placeholder="Ulangi kata sandi Anda"
                           required autocomplete="new-password" />
                    @error('password_confirmation')
                        <p class="text-sm text-red-300 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- Tombol Daftar: Gradien Biru Halus & Jelas --}}
                <div class="flex items-center mt-8">
                    <button type="submit" 
                            class="w-full text-white font-bold py-3.5 rounded-lg uppercase tracking-wider text-base gradient-button">
                        DAFTAR
                    </button>
                </div>
            </form>
            
            {{-- Tautan Masuk (Diperjelas) --}}
            <div class="mt-6 text-center pt-4 border-t border-white/30">
                <p class="text-sm text-white/80">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-white hover:text-gray-100 transition duration-150 ease-in-out underline">
                        Masuk Sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>