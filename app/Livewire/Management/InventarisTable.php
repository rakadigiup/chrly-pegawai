<?php

namespace App\Livewire\Management;

use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class InventarisTable extends Component
{
    use WithPagination;

    public $nama, $kode_produk, $kategori, $stok, $harga, $satuan = 'Unit';
    public $editingProduk = null;
    public $showModal = false;

    protected function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'kode_produk' => 'required|string|unique:produk,kode_produk,' . ($this->editingProduk->id ?? ''),
            'kategori' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string',
        ];
    }

    public function createProduk()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function editProduk(Produk $produk)
    {
        $this->editingProduk = $produk;
        $this->nama = $produk->nama;
        $this->kode_produk = $produk->kode_produk;
        $this->kategori = $produk->kategori;
        $this->stok = $produk->stok;
        $this->harga = $produk->harga;
        $this->satuan = $produk->satuan;
        $this->showModal = true;
    }

    public function save()
    {
        $data = $this->validate();
        $data['aktif'] = true;

        if ($this->editingProduk) {
            $this->editingProduk->update($data);
            $this->dispatch('toast', message: 'Inventaris berhasil diperbarui.');
        } else {
            Produk::create($data);
            $this->dispatch('toast', message: 'Inventaris berhasil ditambahkan.');
        }

        $this->showModal = false;
        $this->resetFields();
    }

    public function deleteProduk(Produk $produk)
    {
        $produk->delete();
        $this->dispatch('toast', message: 'Barang berhasil dihapus.');
    }

    public function resetFields()
    {
        $this->editingProduk = null;
        $this->nama = '';
        $this->kode_produk = 'INV-' . rand(100, 999);
        $this->kategori = '';
        $this->stok = 0;
        $this->harga = 0;
        $this->satuan = 'Unit';
    }

    public function render()
    {
        return view('livewire.management.inventaris', [
            'produk' => Produk::latest()->paginate(10),
        ]);
    }
}
