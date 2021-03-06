<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password','address','type','id_number','handphone','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Userpackage(){
      return $this->hasOne('App\Userpackage');
    }

    public function Rental(){
      return $this->hasMany('App\Rental');
    }

    public function Bank(){
      return $this->hasMany('App\Bank');
    }
}
