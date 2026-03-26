<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lupa Kata Sandi | Uangku</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    
    <style>
        /* BASE CSS (DISALIN DARI LOGIN & REGISTER) */
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
        
        /* Shape 1: Bulatan Besar Kiri Bawah */
        .premium-bg::before {
            width: 450px;
            height: 450px;
            background: #2563eb; 
            bottom: -150px;
            left: -150px;
        }
        
        /* Shape 2: Bulatan Sedang Kanan Atas */
        .premium-bg::after {
            width: 300px;
            height: 300px;
            background: #3b82f6; 
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
            border: 1px solid rgba(255, 255, 255, 0.2); 
            transition: all 0.3s ease-in-out;
        }
        .gradient-button:hover {
            transform: translateY(-2px);
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

        {{-- Kartu Formulir Lupa Kata Sandi: Glassmorphism Mewah --}}
        <div class="w-full max-w-md p-8 sm:p-10 rounded-2xl text-white glass-card">

            {{-- Logo dan Judul --}}
            <div class="mb-8 text-center">
                {{-- Ikon Gembok (Mewakili Keamanan/Reset) --}}
                <svg class="w-16 h-16 mx-auto mb-3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="premiumLockGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#fef2f2;stop-opacity:1" /> 
                            <stop offset="100%" style="stop-color:#d4d4d4;stop-opacity:1" /> 
                        </linearGradient>
                    </defs>
                    <path d="M18 10H6C4.89 10 4 10.89 4 12V20C4 21.11 4.89 22 6 22H18C19.11 22 20 21.11 20 20V12C20 10.89 19.11 10 18 10ZM14 17V15C14 14.45 13.55 14 13 14H11C10.45 14 10 14.45 10 15V17C10 17.55 10.45 18 11 18H13C13.55 18 14 17.55 14 17ZM12 4C10.34 4 9 5.34 9 7V10H15V7C15 5.34 13.66 4 12 4Z" fill="url(#premiumLockGradient)"/>
                </svg>
                <h1 class="text-3xl font-black tracking-wider text-white">RESET SANDI</h1>
                <p class="text-sm text-white/80 mt-1">Verifikasi email Anda</p>
            </div>
            
            {{-- Pesan Pemberitahuan Lupa Sandi --}}
            <div class="mb-6 text-sm text-white/90">
                Lupa kata sandi Anda? Jangan khawatir. Cukup masukkan alamat email Anda, dan kami akan mengirimkan tautan *reset* kata sandi melalui email yang memungkinkan Anda memilih sandi baru.
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-300 p-3 bg-green-700/50 rounded-lg border border-green-500/50">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- 📧 Bidang Email --}}
                <div class="mb-5">
                    <label for="email" class="block font-semibold text-sm text-white mb-2">Alamat Email</label>
                    <input id="email" 
                           class="w-full rounded-lg shadow-sm py-3 px-4 text-base transition duration-200 glass-input" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="contoh@email.com"
                           required autofocus />
                    @error('email')
                        <p class="text-sm text-red-300 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Kirim: Gradien Biru Halus & Jelas --}}
                <div class="flex items-center justify-center mt-8">
                    <button type="submit" 
                            class="w-full text-white font-bold py-3.5 rounded-lg uppercase tracking-wider text-base gradient-button">
                        KIRIM TAUTAN RESET SANDI
                    </button>
                </div>
            </form>
            
            {{-- Tautan Kembali ke Login --}}
            <div class="mt-6 text-center pt-4 border-t border-white/30">
                <a href="{{ route('login') }}" class="font-bold text-white hover:text-gray-100 transition duration-150 ease-in-out underline text-sm">
                    < Kembali ke Halaman Masuk
                </a>
            </div>
        </div>
    </div>
</body>
</html>