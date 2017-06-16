<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
      'rental_id',
      'message'
    ];

    public function Rental(){
      return $this->belongsTo('App\Rental');
    }

    public function Reportpicture(){
      return $this->hasMany('App\Reportpicture');
    }
}
