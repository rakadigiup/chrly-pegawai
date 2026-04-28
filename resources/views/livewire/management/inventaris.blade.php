<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">Manajemen Inventaris</flux:heading>
        <flux:button wire:click="createProduk" icon="plus" variant="primary">Tambah Barang</flux:button>
    </div>

    <flux:card>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>Barang</flux:table.column>
                <flux:table.column>Kode</flux:table.column>
                <flux:table.column>Kategori</flux:table.column>
                <flux:table.column>Stok</flux:table.column>
                <flux:table.column>Harga</flux:table.column>
                <flux:table.column></flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach($produk as $item)
                    <flux:table.row :key="$item->id">
                        <flux:table.cell class="font-medium">{{ $item->nama }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge size="sm" variant="subtle">{{ $item->kode_produk }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>{{ $item->kategori }}</flux:table.cell>
                        <flux:table.cell>{{ $item->stok }} {{ $item->satuan }}</flux:table.cell>
                        <flux:table.cell>{{ $item->formattedHarga() }}</flux:table.cell>
                        <flux:table.cell>
                            <div class="flex items-center gap-2">
                                <flux:button wire:click="editProduk({{ $item->id }})" variant="ghost" icon="pencil" size="sm" />
                                <flux:button wire:click="deleteProduk({{ $item->id }})" wire:confirm="Hapus barang ini?" variant="ghost" icon="trash" size="sm" color="red" />
                            </div>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
        
        <div class="mt-4">
            {{ $produk->links() }}
        </div>
    </flux:card>

    <flux:modal wire:model="showModal" class="md:w-96 space-y-6">
        <div>
            <flux:heading size="lg">{{ $editingProduk ? 'Edit Barang' : 'Tambah Barang' }}</flux:heading>
            <flux:subheading>Isi detail inventaris kantor di bawah ini.</flux:subheading>
        </div>

        <form wire:submit="save" class="space-y-4">
            <flux:input wire:model="nama" label="Nama Barang" placeholder="Contoh: Meja Kerja..." />
            <flux:input wire:model="kode_produk" label="Kode Inventaris" />
            
            <flux:input wire:model="kategori" label="Kategori" placeholder="Contoh: Elektronik, Furniture..." />

            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model="stok" label="Stok" type="number" />
                <flux:input wire:model="satuan" label="Satuan" placeholder="Unit, Pcs, dll" />
            </div>

            <flux:input wire:model="harga" label="Harga Satuan" type="number" prefix="Rp" />

            <div class="flex gap-2 justify-end">
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
