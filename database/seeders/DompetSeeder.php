<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dompet;

class DompetSeeder extends Seeder
{
    public function run(): void
    {
        Dompet::create([
            'user_id' => 1,
            'nama' => 'Rekening BCA',
            'tipe' => 'bank', // ✅ SESUAI ENUM
            'saldo_awal' => 150000,
            'keterangan' => 'Rekening pribadi'
        ]);

        Dompet::create([
            'user_id' => 1,
            'nama' => 'Dompet Tunai',
            'tipe' => 'cash', // ✅ sesuai enum
            'saldo_awal' => 50000,
            'keterangan' => 'Dompet utama pengguna pertama'
        ]);

        Dompet::create([
            'user_id' => 4,
            'nama' => 'Dompet Tambahan',
            'tipe' => 'bank',
            'saldo_awal' => 200000,
            'keterangan' => 'Dompet user 4'
        ]);
    }
}
