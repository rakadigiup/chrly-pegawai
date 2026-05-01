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
    public $members, $member_count, $phone, $arrival_date;
    public $editingUser = null;
    public $showModal = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($this->editingUser->id ?? ''),
            'role' => 'required|in:admin,visitor,pegawai',
            'password' => $this->editingUser ? 'nullable|min:8' : 'required|min:8',
            'members' => 'nullable|string',
            'member_count' => 'nullable|integer|min:1',
            'phone' => 'nullable|string',
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
        $this->role = $user->role;
        $this->members = $user->members;
        $this->member_count = $user->member_count;
        $this->phone = $user->phone;
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
            'role' => $this->role,
            'members' => $this->members,
            'member_count' => $this->member_count,
            'phone' => $this->phone,
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
        $this->role = 'visitor';
        $this->members = '';
        $this->member_count = 1;
        $this->phone = '';
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
