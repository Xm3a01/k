<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['ar_qualification'];


    public function about()
    {
        return belongsTo(About::class);
    }
}
