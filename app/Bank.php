<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
      'user_id',
      'provider',
      'name',
      'number'
    ];

    public function User(){
      return $this->belongsTo('App\User');
    }
}
