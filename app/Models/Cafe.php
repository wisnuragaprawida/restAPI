<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    use HasFactory;
    public function cafeMenu()
    {
        return $this->hasMany('App\Models\Cafe_menu');
    }
}
