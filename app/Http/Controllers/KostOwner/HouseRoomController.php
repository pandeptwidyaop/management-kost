<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Help;
use App\Userpackage;
use App\House;
use Image;
use App\Housepicture;
use Storage;

class HouseRoomController extends Controller
{
    public function index(){
      $token = Help::token();
      $houselimit = 0;
      $can = false;
      $house = 0;
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      if ($userpackage != null) {
        $houselimit = $userpackage->Package->house_limit;
        foreach ($userpackage->House as $h) {
          $house += 1;
        }
        if ($house < $houselimit) {
          $can = true;
        }
      }
      return view('kostowner.houseroom.index',compact('userpackage','can','token'));
    }

    public function create(){
      if (Help::verify($request->key)) {
        return view('kostowner.houseroom.create');
      }else {
        return redirect(Help::url('house-room'));
      }
    }

    public function store(Request $request){
      $data = $request->all();
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      $house = new House;
      $data['userpackage_id'] = $userpackage->id;
      $house->fill($data);
      $house->save();
      if ($request->hasFile('picture')) {
        $file = $request->file('picture');
        foreach ($file as $img => $i) {
          $pict = new Housepicture;
          $name = 'houses/'.$i->hashName();
          $img = Image::make($i)->fit(1024,700,function($const){
            $const->upsize();
          });
          Storage::disk('public')->put($name,$img->stream());
          $pict->url = $name;
          $pict->house_id = $house->id;
          $pict->save();
        }
      }
      Session::flash('alert','Berhasil menambah rumah.');
      return redirect(Help::url('house-room'));
    }

    public function manage($id){
      $data = House::findOrFail($id);
      return view('kostowner.houseroom.manage', compact('data'));
    }
}
