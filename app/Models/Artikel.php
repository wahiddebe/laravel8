<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori', 'kategoris_id');
    }
}
