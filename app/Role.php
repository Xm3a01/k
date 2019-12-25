<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [];

    public function specials()
    {
        return $this->hasMany(Special::class);
    }

    function users() {
        return $this->hasMany(User::class);
    }
}
