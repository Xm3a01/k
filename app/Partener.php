<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partener extends Model
{
    protected $fillable = [];


    public function about()
    {
        return belongsTo(About::class);
    }
}
