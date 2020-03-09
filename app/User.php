<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','country_id','city_id','image','api_token','status','verify_code'
    ];


    public function country(){
        return $this->belongsTo('\App\Country');
    }
    public function city(){
        return $this->belongsTo('\App\City');
    }

    public function Products ()
    {
        return $this->hasMany('\App\Products' ,'owner_id');
    }
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

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new PasswordResetNotification($token));
    // }

}
