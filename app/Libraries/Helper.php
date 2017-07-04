<?php

namespace App\Libraries;

use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Userpackage;
use Carbon\Carbon;

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

  public static function token($text = ''){
    $text = ($text == '')  ? csrf_token() : $text;
    $data =  Hash::make($text);
    return strtr($data,['$2y$10$' => '*']);
  }

  public static function verify($token){
    $data = strtr($token,['*' => '$2y$10$']);
    return Hash::check(csrf_token(),$data);
  }

  public static function encode($string){
    $data = Crypt::encryptString($string);
    return strtr($data,['=' => '*']);
  }

  public static function decode($string){
    $data = strtr($string, ['*' => '=']);
    return Crypt::decryptString($data);
  }

  public static function grant(){
    $r = true;
    $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
    if ($userpackage != null) {
      if ($userpackage->expired != null) {
        if (Carbon::now() > Carbon::parse($userpackage->expired) ) {
          $r = false;
        }
      }
    }
    return $r;
  }
}
