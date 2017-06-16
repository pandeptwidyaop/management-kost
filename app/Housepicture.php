<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Housepicture extends Model
{
    protected $fillable = [
      'house_id',
      'url'
    ];

    public function House(){
      return $this->belongsTo('App\House');
    }
}
