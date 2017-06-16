<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
      'name',
      'address',
      'userpackage_id'
    ];

    public function Userpackage(){
      return $this->belongsTo('App\Userpackage');
    }

    public function Housepicture(){
      return $this->hasMany('App\Housepicture');
    }

    public function Room(){
      return $this->hasMany('App\Room');
    }
}
