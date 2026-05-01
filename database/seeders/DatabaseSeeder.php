<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@wisata.com'],
            [
                'name' => 'Admin Wisata',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        $pegawai = User::updateOrCreate(
            ['email' => 'petugas@wisata.com'],
            [
                'name' => 'Petugas Lapangan',
                'password' => bcrypt('password'),
                'role' => 'pegawai',
            ]
        );

        $visitor = User::updateOrCreate(
            ['email' => 'budi@example.com'],
            [
                'name' => 'Budi Santoso',
                'password' => bcrypt('password'),
                'role' => 'visitor',
                'phone' => '081234567890',
                'member_count' => 3,
                'members' => "Budi Santoso\nSiti Aminah\nAndi Prasetyo",
                'arrival_date' => now()->format('Y-m-d'),
            ]
        );

        // Seed Produk (Inventaris)
        \App\Models\Produk::create([
            'nama' => 'Laptop Dell XPS 13',
            'kode_produk' => 'INV-001',
            'kategori' => 'Elektronik',
            'stok' => 5,
            'satuan' => 'Unit',
            'harga' => 15000000,
            'aktif' => true,
        ]);

        \App\Models\Produk::create([
            'nama' => 'Kursi Kerja Ergonomis',
            'kode_produk' => 'INV-002',
            'kategori' => 'Furniture',
            'stok' => 10,
            'satuan' => 'Pcs',
            'harga' => 2000000,
            'aktif' => true,
        ]);

        // Seed Pekerjaan
        \App\Models\Pekerjaan::create([
            'judul' => 'Update Laporan Inventaris Bulanan',
            'deskripsi' => 'Melakukan pengecekan fisik barang dan update sistem.',
            'prioritas' => 'tinggi',
            'status' => 'dikerjakan',
            'assigned_to' => $pegawai->id,
            'created_by' => $admin->id,
            'deadline' => now()->addDays(3),
        ]);

        \App\Models\Pekerjaan::create([
            'judul' => 'Audit Keamanan Akun User',
            'deskripsi' => 'Memastikan semua user menggunakan 2FA.',
            'prioritas' => 'sedang',
            'status' => 'menunggu',
            'assigned_to' => $pegawai->id,
            'created_by' => $admin->id,
            'deadline' => now()->addDays(7),
        ]);
    }
}
