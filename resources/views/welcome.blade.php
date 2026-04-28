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
                        <div class="w-8 h-8 bg-zinc-900 dark:bg-white rounded flex items-center justify-center text-white dark:text-black font-bold">
                            C
                        </div>
                        <h1 class="text-xl font-bold">{{ config('app.name', 'Sistem Celry') }}</h1>
                    </div>

                    @if (Route::has('login'))
                        <nav class="flex gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:underline">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium hover:underline">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-sm font-medium hover:underline">Register</a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>

                <main class="space-y-6">
                    <div class="space-y-4">
                        <h2 class="text-3xl font-extrabold tracking-tight">Platform Manajemen Karyawan</h2>
                        <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-400">
                            Sistem Celry dirancang sebagai platform manajemen karyawan yang fokus pada efisiensi operasional perusahaan melalui tiga fungsi CRUD utama, yaitu Manajemen User untuk mengelola data identitas dan hak akses akun, Manajemen Pekerjaan untuk pembagian tugas serta monitoring progres kerja staf, dan Manajemen Inventaris Kantor untuk mendata aset perusahaan yang digunakan karyawan.
                        </p>
                    </div>

                    <div class="p-6 bg-zinc-50 dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800">
                        <p class="text-sm italic text-gray-500">
                            "Dalam alur sistem ini, Admin memiliki kendali penuh terhadap seluruh database dan audit organisasi, sementara peran Celry-Pegawai berfungsi sebagai staf manajemen yang menginput data operasional dan memperbarui status pekerjaan harian secara sistematis."
                        </p>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-zinc-900 hover:bg-zinc-800 dark:bg-white dark:text-black dark:hover:bg-zinc-200 transition">
                            Mulai Sekarang
                        </a>
                    </div>
                </main>

                <footer class="pt-12 text-sm text-gray-500">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Sistem Celry') }}. Dibuat untuk efisiensi operasional.
                </footer>
            </div>
        </div>
    </body>
</html>
