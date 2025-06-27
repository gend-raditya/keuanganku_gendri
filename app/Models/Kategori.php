<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
     protected $table = 'gendri_kategoris';
     protected $fillable = ['nama', 'tipe'];
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
