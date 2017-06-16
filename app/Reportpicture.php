<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportpicture extends Model
{
    protected $fillable = [
      'report_id',
      'url'
    ];

    public function Report(){
      return $this->belongsTo('App\Report');
    }
}
