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
}
