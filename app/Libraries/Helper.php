<?php

namespace App\Libraries;

use Auth;

class Helper {

  public static function url($u = ''){
    $url = 'admin/';
    if (Auth::user()->type == 'kost_owner') {
      $url = 'ibu-kost/';
    }elseif (Auth::user()->type == 'tenant') {
      $url = 'anak-kost/';
    }

    return url($url.$u);
  }

  public static function type(){
    $type = 'Admin';
    if (Auth::user()->type == 'kost_owner') {
      $type = 'Ibu Kost';
    }elseif (Auth::user()->type == 'tenant') {
      $type = 'Anak Kost';
    }

    return $type;
  }

  public static function img($img=''){
    return url('images/'.$img);
  }

  public static function js(){
    return 'javascript:void(0);';
  }
}
