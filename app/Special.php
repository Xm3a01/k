<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    protected $fillable = [];

    public function sub_specials()
    {
        return $this->hasMany(SubSpecial::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    function users() {
        return $this->hasMany(User::class);
    }
}
