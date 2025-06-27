<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create(['nama' => 'Gaji', 'tipe' => 'pemasukan']);
        Kategori::create(['nama' => 'Makan', 'tipe' => 'pengeluaran']);
        Kategori::create(['nama' => 'Hiburan', 'tipe' => 'pengeluaran']);
    }
}
