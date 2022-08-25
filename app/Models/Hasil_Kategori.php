<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil_Kategori extends Model
{
    use HasFactory;

    protected $table = 'hasil_kategori';
    public function kategori()
    {
        return $this->belongsTo('App\Models\KategoriKuis', 'kategori_id');
    }
    public function hasil_kuisioner()
    {
        return $this->belongsTo('App\Models\Hasil_Kuisioner');
    }
}
