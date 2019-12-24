<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable =[];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function whyuses()
    {
        return $this->hasMany(Whyus::class);
    }

    public function parteners()
    {
        return $this->hasMany(Partener::class);
    }
}
