<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuisioner extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo('App\Models\KategoriKuis', 'kategori_id');
    }
    public function subkategori()
    {
        return $this->belongsTo('App\Models\SubKategoriKuis', 'sub_kategori_id');
    }
    public function pilihans()
    {
        return $this->hasMany(PilihanKuis::class, 'kuisioner_id');
    }
}
