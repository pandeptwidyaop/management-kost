<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use App\Userpackage;
use Carbon\Carbon;
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

    public function select(Request $request, $id){
      if (Help::verify($request->key)) {
        $package = Package::findOrFail($id);
        if ($package->price == 0) {
          $userpackage = new Userpackage;
          $userpackage->user_id = Auth::user()->id;
          $userpackage->package_id = $id;
          $userpackage->registered = Carbon::now();
          $userpackage->save();
          Session::flash('alert','Paket berhasil digunakan.');
          return back();
        }else {
          $paket = Help::encode($id);
          $action = Help::encode('select');
          $token = Help::token();
          return redirect(Help::url('packages/pricing?p='.$paket.'&a='.$action.'&k='.$token));
        }
      }else {
        return back();
      }
    }

    public function pricing(Request $request){
      $key = $request->k;
      if (Help::verify($key)) {
        $id = Help::decode($request->p);
        $package = Package::findOrFail($id);
        return view('kostowner.package.pricing', compact('package'));
      }else {
        return 'Token Expired , please contact your Administrator';
      }
    }

}
