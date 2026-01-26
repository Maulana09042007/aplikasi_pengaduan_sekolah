<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Kategori extends Model
{
    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class);
    }
}
