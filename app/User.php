<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\UserResetPasswordNotification;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'ar_name',
        'last_name',
        'ar_last_name',
        'sub_special',
        'ar_sub_special',
        'email',
        'password',
        'role',
        'ar_role',
        'country',
        'sub_special',
        'ar_sub_special',
        'salary',
        'ar_brith',
        'brith',
        'salary_type',
        'ar_country',
        'city',
        'ar_city',
        'phone',
        'level_of_work',
        'ar_level_of_work',
        'visit_count',
        'available',
        'avatar',
        'ar_gender',
        'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function exps()
    {
        return $this->hasMany(Exp::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }
    
    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }
}
