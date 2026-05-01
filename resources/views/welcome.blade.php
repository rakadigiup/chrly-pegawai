<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Taman Mini Indonesia Indah</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-zinc-50 dark:bg-zinc-950">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            <div class="max-w-2xl w-full px-6 py-12 text-center space-y-8">
                <div class="flex justify-center">
                    <div class="w-16 h-16 bg-zinc-900 dark:bg-zinc-100 rounded-2xl flex items-center justify-center text-white dark:text-black font-bold text-2xl shadow-lg">
                        TM
                    </div>
                </div>

                <div class="space-y-4">
                    <h1 class="text-4xl font-bold text-zinc-900 dark:text-white tracking-tight">
                        Taman Mini Indonesia Indah
                    </h1>
                    <p class="text-lg text-zinc-600 dark:text-zinc-400">
                        Selamat datang di portal registrasi wisatawan. Silakan daftar atau login untuk mengelola kunjungan Anda.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <flux:button :href="url('/dashboard')" variant="primary" class="w-full sm:w-auto px-8 py-3">
                            Ke Dashboard
                        </flux:button>
                    @else
                        <flux:button :href="route('register')" variant="primary" class="w-full sm:w-auto px-8 py-3">
                            Registrasi Wisatawan
                        </flux:button>
                        <flux:button :href="route('login')" variant="ghost" class="w-full sm:w-auto px-8 py-3">
                            Masuk Ke Akun
                        </flux:button>
                    @endauth
                </div>

                <div class="pt-8 text-sm text-zinc-500">
                    &copy; {{ date('Y') }} Taman Mini Indonesia Indah. Seluruh hak cipta dilindungi.
                </div>
            </div>
        </div>
    </body>
</html>
