<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'gendri_transaksis'; 
   protected $fillable = ['tanggal', 'deskripsi', 'jumlah', 'kategori_id', 'wallet_id', 'user_id'];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // app/Models/Transaksi.php

    public function dompet()
    {
        return $this->belongsTo(Dompet::class, 'wallet_id');
    }
}
