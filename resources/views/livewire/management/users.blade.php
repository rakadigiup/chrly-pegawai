<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1">Manajemen User</flux:heading>
        <flux:button wire:click="createUser" icon="plus" variant="primary">Tambah User</flux:button>
    </div>

    <flux:card>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>Nama</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Role</flux:table.column>
                <flux:table.column></flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach($users as $user)
                    <flux:table.row :key="$user->id">
                        <flux:table.cell class="flex items-center gap-2">
                            <flux:avatar :name="$user->name" size="sm" />
                            <span class="font-medium">{{ $user->name }}</span>
                        </flux:table.cell>
                        <flux:table.cell>{{ $user->email }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge :color="$user->role === 'admin' ? 'purple' : 'blue'" size="sm">
                                {{ ucfirst($user->role) }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="flex items-center gap-2">
                                <flux:button wire:click="editUser({{ $user->id }})" variant="ghost" icon="pencil" size="sm" />
                                <flux:button wire:click="deleteUser({{ $user->id }})" wire:confirm="Yakin ingin menghapus user ini?" variant="ghost" icon="trash" size="sm" color="red" />
                            </div>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
        
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </flux:card>

    <flux:modal wire:model="showModal" class="md:w-96 space-y-6">
        <div>
            <flux:heading size="lg">{{ $editingUser ? 'Edit User' : 'Tambah User' }}</flux:heading>
            <flux:subheading>Isi detail informasi user di bawah ini.</flux:subheading>
        </div>

        <form wire:submit="save" class="space-y-4">
            <flux:input wire:model="name" label="Nama Lengkap" placeholder="Masukkan nama..." />
            <flux:input wire:model="email" label="Alamat Email" type="email" placeholder="email@contoh.com" />
            
            <flux:select wire:model="role" label="Role">
                <option value="admin">Admin</option>
                <option value="pegawai">Pegawai</option>
            </flux:select>

            <flux:input wire:model="password" label="Password" type="password" placeholder="{{ $editingUser ? 'Kosongkan jika tidak ingin mengubah' : 'Minimal 8 karakter' }}" />

            <div class="flex gap-2 justify-end">
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
