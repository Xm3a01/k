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

    public function sub_special()
    {
        return $this->belongsTo(SubSpecial::class);
    }

    public function special()
    {
        return $this->belongsTo(Specials::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
