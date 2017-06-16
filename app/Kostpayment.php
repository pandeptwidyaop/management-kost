<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kostpayment extends Model
{
    protected $fillable = [
      'rental_id',
      'month',
      'year',
      'price',
      'status'
    ];

    public function Rental(){
      return $this->belongsTo('App\Rental');
    }
}
