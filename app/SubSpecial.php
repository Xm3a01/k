<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSpecial extends Model
{
    protected $fillable = [];

    public function special()
    {
        return $this->belongsTo(Special::class);
    }

    function users() {
        return $this->hasMany(User::class);
    }

    function educations() {
        return $this->hasMany(Education::class);
    }
}
