<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public function berita()
    {
        return $this->belongsTo('App\Models\Berita');
    }

    public function artikel()
    {
        return $this->belongsTo('App\Models\Artikel');
    }
}
