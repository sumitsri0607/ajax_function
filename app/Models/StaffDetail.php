<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDetail extends Model
{
    use HasFactory;

    protected $table = "staff_details";

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function hobby()
    {
        return $this->hasMany('App\Models\Hobby');
    }
    
}
