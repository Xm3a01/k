<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
   protected $fillable =['user_id' , 'qualification' , 'grade_date' , 'grade' , 'ar_university' , 'university'];

   public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function sub_specials()
   {
       return $this->hasMany(SubSpecialp::class);
   }
}
