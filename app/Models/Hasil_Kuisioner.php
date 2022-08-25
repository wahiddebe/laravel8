<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil_Kuisioner extends Model
{
    use HasFactory;
    public function kategori()
    {
        return $this->belongsTo('App\Models\KategoriKuis', 'kategori_id');
    }
    public function hasil_kategori()
    {
        return $this->belongsTo('App\Models\Hasil_Kategori', 'hasil_kategori_id');
    }
}
