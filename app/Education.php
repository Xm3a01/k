<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
   protected $fillable =['user_id' , 'qualification', 'ar_qualification' , 'grade_date' , 'grade' , 'ar_university' , 'university' , 'sub_special_id'];

   public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function sub_special()
   {
       return $this->belongsTo(SubSpecial::class);
   }
}
