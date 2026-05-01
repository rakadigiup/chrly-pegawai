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
                'address' => 'Jl. Merdeka No. 123, Jakarta Pusat',
                'arrival_date' => now()->format('Y-m-d'),
            ]
        );

    }
}
