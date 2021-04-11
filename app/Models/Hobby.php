<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;

    protected $table = 'hobby';

    // public function getHobbyAttribute()
    // {
    //     $hobby = Hobby::all();
    //     return implode(', ', $hobby);
    // }
}
