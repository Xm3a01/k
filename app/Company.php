<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }


    public function owner()
    {
        return $this->hasbelongsTo(Owner::class);
    }

    public function country()
    {
        return $this->hasbelongsTo(Country::class);
    }
}
