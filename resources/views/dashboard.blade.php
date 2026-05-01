<x-layouts::app :title="__('Dashboard')">
    <div class="space-y-6">
        @if(auth()->user()->role === 'admin')
            {{-- Admin Dashboard --}}
            <div class="flex items-center justify-between">
                <flux:heading level="1">Dashboard Admin</flux:heading>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <flux:card class="space-y-2">
                    <flux:heading level="3">Total Wisatawan</flux:heading>
                    <flux:text class="text-3xl font-bold">{{ \App\Models\User::where('role', 'visitor')->count() }}</flux:text>
                </flux:card>

                <flux:card class="space-y-2">
                    <flux:heading level="3">Kedatangan Hari Ini</flux:heading>
                    <flux:text class="text-3xl font-bold">{{ \App\Models\User::where('role', 'visitor')->whereDate('arrival_date', today())->count() }}</flux:text>
                </flux:card>
            </div>

            <flux:card>
                <div class="flex items-center justify-between mb-4">
                    <flux:heading level="2">Pendaftaran Terbaru</flux:heading>
                    <flux:button size="sm" variant="subtle" :href="route('users.index')">Kelola User</flux:button>
                </div>
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>Nama</flux:table.column>
                        <flux:table.column>No HP</flux:table.column>
                        <flux:table.column>Alamat</flux:table.column>
                        <flux:table.column>Tanggal</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        @foreach(\App\Models\User::where('role', 'visitor')->latest()->take(10)->get() as $visitor)
                            <flux:table.row>
                                <flux:table.cell>{{ $visitor->name }}</flux:table.cell>
                                <flux:table.cell>{{ $visitor->phone }}</flux:table.cell>
                                <flux:table.cell>{{ Str::limit($visitor->address, 30) }}</flux:table.cell>
                                <flux:table.cell>{{ $visitor->arrival_date?->format('d/m/Y') ?? '-' }}</flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            </flux:card>
        @else
            {{-- Visitor/Wisatawan Dashboard --}}
            <flux:card class="space-y-4">
                <flux:heading level="1">Selamat Datang, {{ auth()->user()->name }}!</flux:heading>
                <flux:text>Anda telah berhasil melakukan pendaftaran di sistem Taman Mini Indonesia Indah.</flux:text>
                
                <div class="p-4 bg-zinc-50 dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                    <flux:heading level="3">Status Pendaftaran</flux:heading>
                    <flux:text class="mt-1 text-green-600 dark:text-green-400 font-semibold">Aktif & Terverifikasi</flux:text>
                    <flux:text class="mt-2">Silakan tunjukkan nama Anda ke petugas di gerbang utama untuk verifikasi masuk.</flux:text>
                </div>
            </flux:card>
        @endif
    </div>
</x-layouts::app>
