<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packagepayment extends Model
{
    protected $fillable = [
      'userpackage_id',
      'price',
      'month',
      'year',
      'status'
    ];

    public function Userpackage(){
      return $this->belongsTo('App\Userpackage');
    }
}
