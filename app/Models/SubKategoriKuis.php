<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategoriKuis extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo('App\Models\KategoriKuis', 'kategori_id');
    }

    public function kuisioner()
    {
        return $this->belongsTo('App\Models\Kuisioner');
    }
}
