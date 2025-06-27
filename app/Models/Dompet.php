<?php
// app/Models/Dompet.php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dompet extends Model
{
    protected $table = 'gendri_dompet';

    protected $fillable = ['user_id', 'nama', 'tipe', 'saldo_awal', 'keterangan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function transaksis()
    {
        return $this->hasMany(\App\Models\Transaksi::class, 'wallet_id');
    }
}
