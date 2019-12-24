<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exp extends Model
{
    protected $fillable = [];

    function user() {
        return $this->belongsTo(User::class);
    }

    function roles() {
        return $this->hasMany(Role::class);
    }

    function sub_specials() {
        return $this->hasMany(SubSpecial::class);
    }

    function levels() {
        return $this->hasMany(Level::class);
    }

    function countries() {
        return $this->hasMany(Country::class);
    }
}
