<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['user_id' , 'name' , 'ar_name', 'attch'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
