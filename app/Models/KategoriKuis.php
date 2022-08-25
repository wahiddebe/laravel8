<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKuis extends Model
{
    use HasFactory;

    public function subkategori()
    {
        return $this->belongsTo('App\Models\SubKategoriKuis');
    }
    public function hasil_kategori()
    {
        return $this->belongsTo('App\Models\Hasil_Kategori');
    }
    public function kuisioner()
    {
        return $this->belongsTo('App\Models\Kuisioner');
    }
    public function hasil_kuisioner()
    {
        return $this->belongsTo('App\Models\Hasil_Kuisioner');
    }
}
