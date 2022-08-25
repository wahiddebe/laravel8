<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanKuis extends Model
{
    use HasFactory;

    public function kuisioners()
    {
        return $this->belongsToMany(Kuisioner::class);
    }
}
