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

    public $name, $email, $role = 'visitor', $password;
    public $phone, $address, $arrival_date;
    public $editingUser = null;
    public $showModal = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($this->editingUser->id ?? ''),
            'password' => $this->editingUser ? 'nullable|min:8' : 'required|min:8',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'arrival_date' => 'nullable|date',
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
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->arrival_date = $user->arrival_date?->format('Y-m-d');
        $this->password = '';
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'arrival_date' => $this->arrival_date,
        ];

        if ($this->editingUser) {
            $this->editingUser->update($data);

            if ($this->password) {
                $this->editingUser->update(['password' => Hash::make($this->password)]);
            }
            
            $this->dispatch('toast', message: 'User berhasil diperbarui.');
        } else {
            $data['password'] = Hash::make($this->password);
            User::create($data);
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
        $this->phone = '';
        $this->address = '';
        $this->arrival_date = '';
        $this->password = '';
    }

    public function render()
    {
        return view('livewire.management.users', [
            'users' => User::latest()->paginate(10),
        ]);
    }
}
