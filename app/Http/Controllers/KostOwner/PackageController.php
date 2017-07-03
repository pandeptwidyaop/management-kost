<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use App\Userpackage;
use Auth;
use Help;
use Session;

class PackageController extends Controller
{
    public function index()
    {
      $house = 0;
      $room = 0;
      $key = Help::token();
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      $package = Package::all();
      if ($userpackage != null) {
        foreach ($userpackage->House as $h) {
          $house += 1;
          foreach ($h->Room as $r) {
            $room += 1;
          }
        }
      }
      return view('kostowner.package.index', compact('userpackage','package','house','room','key'));
    }

}
