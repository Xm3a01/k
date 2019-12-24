<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function sub_specials()
    {
        return $this->hasMany(SubSpecials::class);
    }

    public function specials()
    {
        return $this->hasMany(Specials::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function countries()
    {
        return $this->hasMany(Country::class);
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }
}
