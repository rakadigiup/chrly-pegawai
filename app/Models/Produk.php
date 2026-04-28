<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'kode_produk',
        'deskripsi',
        'kategori',
        'harga',
        'stok',
        'satuan',
        'gambar',
        'aktif',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'aktif' => 'boolean',
    ];

    public function formattedHarga(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
