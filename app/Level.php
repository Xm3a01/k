<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [];

    function users() {
        return $this->hasMany(User::class);
    }
    
}
