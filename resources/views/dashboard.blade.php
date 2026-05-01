<x-layouts::app :title="__('Dashboard')">
    <div class="space-y-6">
        @if(auth()->user()->role === 'admin')
            {{-- Admin Dashboard --}}
            <div class="grid gap-4 md:grid-cols-3">
                <flux:card class="space-y-2">
                    <div class="flex items-center gap-2">
                        <flux:icon.users class="text-gray-400" />
                        <flux:heading level="3">Total Wisatawan</flux:heading>
                    </div>
                    <flux:text class="text-3xl font-bold">{{ \App\Models\User::where('role', 'visitor')->count() }}</flux:text>
                </flux:card>

                <flux:card class="space-y-2">
                    <div class="flex items-center gap-2">
                        <flux:icon.user-group class="text-gray-400" />
                        <flux:heading level="3">Total Pengunjung</flux:heading>
                    </div>
                    <flux:text class="text-3xl font-bold">{{ \App\Models\User::where('role', 'visitor')->sum('member_count') }}</flux:text>
                </flux:card>

                <flux:card class="space-y-2">
                    <div class="flex items-center gap-2">
                        <flux:icon.calendar class="text-gray-400" />
                        <flux:heading level="3">Kedatangan Hari Ini</flux:heading>
                    </div>
                    <flux:text class="text-3xl font-bold">{{ \App\Models\User::where('role', 'visitor')->whereDate('arrival_date', today())->count() }}</flux:text>
                </flux:card>
            </div>

            <flux:card>
                <div class="flex items-center justify-between mb-4">
                    <flux:heading level="2">Daftar Wisatawan Terbaru</flux:heading>
                    <flux:button size="sm" variant="subtle" :href="route('users.index')">Lihat Semua</flux:button>
                </div>
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>Nama</flux:table.column>
                        <flux:table.column>No HP</flux:table.column>
                        <flux:table.column>Jumlah Anggota</flux:table.column>
                        <flux:table.column>Tanggal Datang</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        @foreach(\App\Models\User::where('role', 'visitor')->latest()->take(10)->get() as $visitor)
                            <flux:table.row>
                                <flux:table.cell class="font-medium">{{ $visitor->name }}</flux:table.cell>
                                <flux:table.cell>{{ $visitor->phone }}</flux:table.cell>
                                <flux:table.cell>{{ $visitor->member_count }}</flux:table.cell>
                                <flux:table.cell>{{ $visitor->arrival_date?->format('d M Y') ?? '-' }}</flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            </flux:card>
        @else
            {{-- Visitor/Wisatawan Dashboard --}}
            <div class="grid gap-6">
                <flux:card class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-300 text-2xl font-bold">
                            {{ auth()->user()->initials() }}
                        </div>
                        <div>
                            <flux:heading level="2">Halo, {{ auth()->user()->name }}!</flux:heading>
                            <flux:text>Terima kasih telah melakukan registrasi. Berikut adalah data kunjungan Anda.</flux:text>
                        </div>
                    </div>
                </flux:card>

                <div class="grid gap-4 md:grid-cols-2">
                    <flux:card class="space-y-4">
                        <flux:heading level="3">Detail Kunjungan</flux:heading>
                        <div class="space-y-3">
                            <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-800 pb-2">
                                <flux:text class="font-medium">Tanggal Kedatangan</flux:text>
                                <flux:text>{{ auth()->user()->arrival_date?->format('d F Y') ?? '-' }}</flux:text>
                            </div>
                            <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-800 pb-2">
                                <flux:text class="font-medium">Nomor Telepon</flux:text>
                                <flux:text>{{ auth()->user()->phone }}</flux:text>
                            </div>
                            <div class="flex justify-between border-b border-zinc-100 dark:border-zinc-800 pb-2">
                                <flux:text class="font-medium">Jumlah Anggota</flux:text>
                                <flux:text>{{ auth()->user()->member_count }} Orang</flux:text>
                            </div>
                        </div>
                    </flux:card>

                    <flux:card class="space-y-4">
                        <flux:heading level="3">Daftar Anggota</flux:heading>
                        <div class="p-4 bg-zinc-50 dark:bg-zinc-900 rounded-lg">
                            <flux:text class="whitespace-pre-line">{{ auth()->user()->members }}</flux:text>
                        </div>
                    </flux:card>
                </div>

                <flux:card class="bg-blue-600 text-white space-y-2">
                    <flux:heading level="3" class="text-white">Informasi Penting</flux:heading>
                    <flux:text class="text-blue-100">Silakan tunjukkan halaman ini kepada petugas loket saat Anda tiba di lokasi wisata untuk memverifikasi data kunjungan Anda.</flux:text>
                </flux:card>
            </div>
        @endif
    </div>
</x-layouts::app>
