<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
      'house_limit',
      'room_limit',
      'price',
      'description',
      'name'
    ];

    public function Userpackage(){
      return $this->hasMany('App\Userpackage');
    }
}
