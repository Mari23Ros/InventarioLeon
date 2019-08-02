<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function worker()
    {
        return $this->hasOne('App\Worker');
    }
    public function movement_buyers(){
        return $this->hasMany('App\Movement', 'buyer', 'id');
    }
    public function movement_authorizers(){
        return $this->hasMany('App\Movement', 'authorizer', 'id');
    }
    public function movement_deliverers(){
        return $this->hasMany('App\Movement', 'deliverer', 'id');
    }
    public function movement_recievers(){
        return $this->hasMany('App\Movement', 'reciever', 'id');
    }
}
