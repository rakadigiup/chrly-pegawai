<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Sistem Celry') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] antialiased">
        <div class="min-h-screen flex flex-col items-center justify-center p-6">
            <div class="w-full max-w-2xl space-y-8">
                <header class="flex items-center justify-between border-b border-gray-200 dark:border-zinc-800 pb-6">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-600 dark:bg-blue-400 rounded flex items-center justify-center text-white dark:text-black font-bold">
                            W
                        </div>
                        <h1 class="text-xl font-bold">{{ config('app.name', 'Wisata App') }}</h1>
                    </div>

                    @if (Route::has('login'))
                        <nav class="flex gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:underline">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium hover:underline">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-sm font-medium hover:underline">Registrasi</a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>

                <main class="space-y-6">
                    <div class="space-y-4">
                        <h2 class="text-3xl font-extrabold tracking-tight">Sistem Registrasi Wisatawan</h2>
                        <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-400">
                            Selamat datang di portal pendaftaran wisatawan. Untuk kenyamanan dan keamanan bersama, seluruh pengunjung diwajibkan untuk melakukan registrasi data diri dan anggota rombongan sebelum memasuki kawasan wisata.
                        </p>
                    </div>

                    <div class="p-6 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                        <p class="text-sm italic text-gray-500">
                            "Pastikan data yang Anda masukkan akurat, termasuk jumlah anggota rombongan dan nomor telepon yang dapat dihubungi untuk mempermudah koordinasi selama di lokasi wisata."
                        </p>
                    </div>

                    <div class="flex gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-500 dark:bg-blue-400 dark:text-black dark:hover:bg-blue-300 transition">
                                Lihat Data Saya
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-500 dark:bg-blue-400 dark:text-black dark:hover:bg-blue-300 transition">
                                Registrasi Sekarang
                            </a>
                        @endauth
                    </div>
                </main>

                <footer class="pt-12 text-sm text-gray-500">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Wisata App') }}. Portal Manajemen Pengunjung Kawasan Wisata.
                </footer>
            </div>
        </div>
    </body>
</html>
