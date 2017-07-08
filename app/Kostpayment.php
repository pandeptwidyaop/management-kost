<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kostpayment extends Model
{
    protected $fillable = [
      'rental_id',
      'date',
      'price',
      'status',
      'image'
    ];

    public function Rental(){
      return $this->belongsTo('App\Rental');
    }
}
