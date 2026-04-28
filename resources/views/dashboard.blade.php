<x-layouts::app :title="__('Dashboard')">
    <div class="space-y-6">
        @if(auth()->user()->role === 'admin')
            {{-- Admin Dashboard --}}
            <div class="grid gap-4 md:grid-cols-3">
                <flux:card class="space-y-2">
                    <div class="flex items-center gap-2">
                        <flux:icon.users class="text-gray-400" />
                        <flux:heading level="3">Total User</flux:heading>
                    </div>
                    <flux:text class="text-3xl font-bold">{{ \App\Models\User::count() }}</flux:text>
                </flux:card>

                <flux:card class="space-y-2">
                    <div class="flex items-center gap-2">
                        <flux:icon.briefcase class="text-gray-400" />
                        <flux:heading level="3">Total Pekerjaan</flux:heading>
                    </div>
                    <flux:text class="text-3xl font-bold">{{ \App\Models\Pekerjaan::count() }}</flux:text>
                </flux:card>

                <flux:card class="space-y-2">
                    <div class="flex items-center gap-2">
                        <flux:icon.archive-box class="text-gray-400" />
                        <flux:heading level="3">Total Inventaris</flux:heading>
                    </div>
                    <flux:text class="text-3xl font-bold">{{ \App\Models\Produk::count() }}</flux:text>
                </flux:card>
            </div>

            <flux:card>
                <div class="flex items-center justify-between mb-4">
                    <flux:heading level="2">Pekerjaan Terbaru</flux:heading>
                    <flux:button size="sm" variant="subtle">Lihat Semua</flux:button>
                </div>
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>Judul</flux:table.column>
                        <flux:table.column>Petugas</flux:table.column>
                        <flux:table.column>Status</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        @foreach(\App\Models\Pekerjaan::latest()->take(5)->get() as $kerja)
                            <flux:table.row>
                                <flux:table.cell class="font-medium">{{ $kerja->judul }}</flux:table.cell>
                                <flux:table.cell>{{ $kerja->assignedTo->name ?? '-' }}</flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge :color="$kerja->status === 'selesai' ? 'green' : ($kerja->status === 'dikerjakan' ? 'yellow' : 'zinc')">
                                        {{ $kerja->badgeStatus() }}
                                    </flux:badge>
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            </flux:card>
        @else
            {{-- Staff/Pegawai Dashboard --}}
            <div class="grid gap-4 md:grid-cols-2">
                <flux:card class="space-y-2">
                    <flux:heading level="3">Selamat Datang, {{ auth()->user()->name }}</flux:heading>
                    <flux:text>Anda login sebagai staf manajemen operasional Sistem Celry.</flux:text>
                </flux:card>

                <flux:card class="space-y-2">
                    <flux:heading level="3">Tugas Saya</flux:heading>
                    <div class="flex items-baseline gap-2">
                        <flux:text class="text-3xl font-bold">{{ \App\Models\Pekerjaan::where('assigned_to', auth()->id())->where('status', '!=', 'selesai')->count() }}</flux:text>
                        <flux:text>Pekerjaan Aktif</flux:text>
                    </div>
                </flux:card>
            </div>

            <flux:card>
                <flux:heading level="2" class="mb-4">Daftar Tugas Anda</flux:heading>
                <div class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse(\App\Models\Pekerjaan::where('assigned_to', auth()->id())->where('status', '!=', 'selesai')->latest()->get() as $tugas)
                        <div class="py-4 flex items-center justify-between">
                            <div class="space-y-1">
                                <flux:text class="font-bold">{{ $tugas->judul }}</flux:text>
                                <flux:text size="sm" class="text-gray-500">Deadline: {{ $tugas->deadline?->format('d M Y') ?? 'Tidak ada deadline' }}</flux:text>
                            </div>
                            <div class="flex items-center gap-3">
                                <flux:badge :color="$tugas->status === 'dikerjakan' ? 'yellow' : 'zinc'">
                                    {{ $tugas->badgeStatus() }}
                                </flux:badge>
                                <flux:button size="sm" variant="ghost" icon="pencil-square" />
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center">
                            <flux:text class="italic text-gray-500">Bagus! Tidak ada tugas yang menunggu saat ini.</flux:text>
                        </div>
                    @endforelse
                </div>
            </flux:card>
        @endif
    </div>
</x-layouts::app>
