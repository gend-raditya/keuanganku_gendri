<?php
// app/Models/Anggaran.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    protected $table = 'gendri_anggaran';

    protected $fillable = ['user_id', 'kategori_id', 'bulan', 'tahun', 'jumlah'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
