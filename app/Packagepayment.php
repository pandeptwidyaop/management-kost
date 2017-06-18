<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packagepayment extends Model
{
    protected $fillable = [
      'userpackage_id',
      'price',
      'start_periode',
      'end_periode',
      'status',
      'image'
    ];

    public function Userpackage(){
      return $this->belongsTo('App\Userpackage');
    }
}
