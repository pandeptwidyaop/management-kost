<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userpackage extends Model
{
    protected $fillable = [
      'user_id',
      'package_id',
      'registered',
      'expired',
      'status'
    ];

    public function User(){
      return $this->belongsTo('App\User');
    }

    public function Package(){
      return $this->belongsTo('App\Package');
    }

    public function Packagepayment(){
      return $this->hasMany('App\Packagepayment');
    }

    public function House(){
      return $this->hasMany('App\House');
    }
}
