<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
      'house_id',
      'number',
      'facility',
      'price'
    ];

    public function House(){
      return $this->belongsTo('App\House');
    }

    public function Rental(){
      return $this->hasMany('App\Rental');
    }
}
