<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name' ,'ar_name' ,'country_id'];

    function country() {
        return $this->belongsTo(Country::class);
    }
}
