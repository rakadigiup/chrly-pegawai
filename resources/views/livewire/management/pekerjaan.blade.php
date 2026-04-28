<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">Manajemen Pekerjaan</flux:heading>
        @if(auth()->user()->role === 'admin')
            <flux:button wire:click="createPekerjaan" icon="plus" variant="primary">Tambah Tugas</flux:button>
        @endif
    </div>

    <flux:card>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>Tugas</flux:table.column>
                @if(auth()->user()->role === 'admin')
                    <flux:table.column>Petugas</flux:table.column>
                @endif
                <flux:table.column>Prioritas</flux:table.column>
                <flux:table.column>Status</flux:table.column>
                <flux:table.column>Deadline</flux:table.column>
                <flux:table.column></flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach($pekerjaan as $kerja)
                    <flux:table.row :key="$kerja->id">
                        <flux:table.cell>
                            <div class="font-medium">{{ $kerja->judul }}</div>
                            <div class="text-xs text-gray-500 truncate max-w-xs">{{ $kerja->deskripsi }}</div>
                        </flux:table.cell>
                        @if(auth()->user()->role === 'admin')
                            <flux:table.cell>{{ $kerja->assignedTo->name ?? '-' }}</flux:table.cell>
                        @endif
                        <flux:table.cell>
                            <flux:badge :color="$kerja->prioritas === 'tinggi' ? 'red' : ($kerja->prioritas === 'sedang' ? 'yellow' : 'blue')" size="sm">
                                {{ $kerja->badgePrioritas() }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge :color="$kerja->status === 'selesai' ? 'green' : ($kerja->status === 'dikerjakan' ? 'yellow' : 'zinc')" size="sm">
                                {{ $kerja->badgeStatus() }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>{{ $kerja->deadline?->format('d M Y') ?? '-' }}</flux:table.cell>
                        <flux:table.cell>
                            <div class="flex items-center gap-2">
                                <flux:button wire:click="editPekerjaan({{ $kerja->id }})" variant="ghost" icon="pencil" size="sm" />
                                @if(auth()->user()->role === 'admin')
                                    <flux:button wire:click="deletePekerjaan({{ $kerja->id }})" wire:confirm="Hapus tugas ini?" variant="ghost" icon="trash" size="sm" color="red" />
                                @endif
                            </div>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
        
        <div class="mt-4">
            {{ $pekerjaan->links() }}
        </div>
    </flux:card>

    <flux:modal wire:model="showModal" class="md:w-[500px] space-y-6">
        <div>
            <flux:heading size="lg">{{ $editingPekerjaan ? 'Edit Pekerjaan' : 'Tambah Pekerjaan' }}</flux:heading>
            <flux:subheading>Tentukan detail tugas dan petugas di bawah ini.</flux:subheading>
        </div>

        <form wire:submit="save" class="space-y-4">
            <flux:input wire:model="judul" label="Judul Pekerjaan" placeholder="Contoh: Audit Keamanan..." :disabled="auth()->user()->role !== 'admin'" />
            <flux:textarea wire:model="deskripsi" label="Deskripsi" placeholder="Detail instruksi..." :disabled="auth()->user()->role !== 'admin'" />
            
            <div class="grid grid-cols-2 gap-4">
                <flux:select wire:model="prioritas" label="Prioritas" :disabled="auth()->user()->role !== 'admin'">
                    <option value="rendah">Rendah</option>
                    <option value="sedang">Sedang</option>
                    <option value="tinggi">Tinggi</option>
                </flux:select>

                <flux:select wire:model="status" label="Status">
                    <option value="menunggu">Menunggu</option>
                    <option value="dikerjakan">Dikerjakan</option>
                    <option value="selesai">Selesai</option>
                </flux:select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <flux:select wire:model="assigned_to" label="Ditugaskan Ke" :disabled="auth()->user()->role !== 'admin'">
                    <option value="">Pilih Pegawai...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </flux:select>

                <flux:input wire:model="deadline" label="Deadline" type="date" :disabled="auth()->user()->role !== 'admin'" />
            </div>

            <div class="flex gap-2 justify-end">
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
