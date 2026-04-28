<?php

namespace App\Livewire\Management;

use App\Models\Pekerjaan;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PekerjaanTable extends Component
{
    use WithPagination;

    public $judul, $deskripsi, $prioritas = 'sedang', $status = 'menunggu', $assigned_to, $deadline;
    public $editingPekerjaan = null;
    public $showModal = false;

    protected function rules()
    {
        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'status' => 'required|in:menunggu,dikerjakan,selesai',
            'assigned_to' => 'required|exists:users,id',
            'deadline' => 'nullable|date',
        ];
    }

    public function createPekerjaan()
    {
        abort_if(auth()->user()->role !== 'admin', 403);
        $this->resetFields();
        $this->showModal = true;
    }

    public function editPekerjaan(Pekerjaan $pekerjaan)
    {
        if (auth()->user()->role !== 'admin') {
            abort_if($pekerjaan->assigned_to !== auth()->id(), 403);
        }

        $this->editingPekerjaan = $pekerjaan;
        $this->judul = $pekerjaan->judul;
        $this->deskripsi = $pekerjaan->deskripsi;
        $this->prioritas = $pekerjaan->prioritas;
        $this->status = $pekerjaan->status;
        $this->assigned_to = $pekerjaan->assigned_to;
        $this->deadline = $pekerjaan->deadline?->format('Y-m-d');
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->editingPekerjaan) {
            if (auth()->user()->role === 'admin') {
                $data = $this->validate();
                $this->editingPekerjaan->update($data);
            } else {
                $this->validate(['status' => 'required|in:menunggu,dikerjakan,selesai']);
                $this->editingPekerjaan->update(['status' => $this->status]);
            }
            $this->dispatch('toast', message: 'Pekerjaan berhasil diperbarui.');
        } else {
            abort_if(auth()->user()->role !== 'admin', 403);
            $data = $this->validate();
            $data['created_by'] = auth()->id();
            Pekerjaan::create($data);
            $this->dispatch('toast', message: 'Pekerjaan berhasil ditambahkan.');
        }

        $this->showModal = false;
        $this->resetFields();
    }

    public function deletePekerjaan(Pekerjaan $pekerjaan)
    {
        abort_if(auth()->user()->role !== 'admin', 403);
        $pekerjaan->delete();
        $this->dispatch('toast', message: 'Pekerjaan berhasil dihapus.');
    }

    public function resetFields()
    {
        $this->editingPekerjaan = null;
        $this->judul = '';
        $this->deskripsi = '';
        $this->prioritas = 'sedang';
        $this->status = 'menunggu';
        $this->assigned_to = '';
        $this->deadline = '';
    }

    public function render()
    {
        $query = Pekerjaan::with('assignedTo')->latest();
        if (auth()->user()->role !== 'admin') {
            $query->where('assigned_to', auth()->id());
        }

        return view('livewire.management.pekerjaan', [
            'pekerjaan' => $query->paginate(10),
            'users' => User::where('role', 'pegawai')->get(),
        ]);
    }
}
