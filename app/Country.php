<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name','ar_name'];


    function cities() {
        return $this->hasMany(City::class);
    }
}
