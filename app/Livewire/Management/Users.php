<?php

namespace App\Livewire\Management;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use livewire\flux;

class Users extends Component
{
    use WithPagination;

    public $name, $email, $role = 'pegawai', $password;
    public $editingUser = null;
    public $showModal = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($this->editingUser->id ?? ''),
            'role' => 'required|in:admin,pegawai',
            'password' => $this->editingUser ? 'nullable|min:8' : 'required|min:8',
        ];
    }

    public function createUser()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function editUser(User $user)
    {
        $this->editingUser = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->password = '';
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editingUser) {
            $this->editingUser->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ]);

            if ($this->password) {
                $this->editingUser->update(['password' => Hash::make($this->password)]);
            }
            
            $this->dispatch('toast', message: 'User berhasil diperbarui.');
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'password' => Hash::make($this->password),
            ]);
            $this->dispatch('toast', message: 'User berhasil ditambahkan.');
        }

        $this->showModal = false;
        $this->resetFields();
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        $this->dispatch('toast', message: 'User berhasil dihapus.');
    }

    public function resetFields()
    {
        $this->editingUser = null;
        $this->name = '';
        $this->email = '';
        $this->role = 'pegawai';
        $this->password = '';
    }

    public function render()
    {
        return view('livewire.management.users', [
            'users' => User::latest()->paginate(10),
        ]);
    }
}
