<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportpicture extends Model
{
    protected $fillable = [
      'report_id',
      'url',
      'read_status'
    ];

    public function Report(){
      return $this->belongsTo('App\Report');
    }
}
