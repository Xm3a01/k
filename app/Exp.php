<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exp extends Model
{
    protected $fillable = [];

    function user() {
        return $this->belongsTo(User::class);
    }

    function role() {
        return $this->belongsTo(Role::class);
    }

    function sub_special() {
        return $this->belongsTo(SubSpecial::class);
    }

    function level() {
        return $this->belongsTo(Level::class);
    }

    function country() {
        return $this->belongsTo(Country::class);
    }
}
