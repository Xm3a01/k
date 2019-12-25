<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\OwnerResetPasswordNotification;
use Illuminate\Notifications\Notifiable;

class Owner extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;


    protected $guard = 'owner';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'visit_count',
        'role_id',
        'country_id',
        'ar_name'

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


    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new OwnerResetPasswordNotification($token));
    }
}