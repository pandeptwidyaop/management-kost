<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
      'room_id',
      'user_id',
      'status'
    ];

    public function Room(){
      return $this->belongsTo('App\Room');
    }
    public function User(){
      return $this->belongsTo('App\User');
    }
    public function Kostpayment(){
      return $this->hasMany('App\Kostpayment');
    }
    public function Report(){
      return $this->hasMany('App\Report');
    }
}
