<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Help;
use App\Userpackage;
use App\House;
use App\Room;
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

    public function create(Request $request){
      if (Help::verify($request->key) && $this->getHouseStatus()) {
        return view('kostowner.houseroom.create');
      }else {
        return redirect(Help::url('house-room'));
      }
    }

    public function store(Request $request){
      if (!$this->getHouseStatus()) {
        return redirect(Help::url('house-room'));
      }
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
          $img = Image::make($i)->fit(1400,500,function($const){
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
      $token = Help::token();
      $data = House::findOrFail($id);
      $can = $this->getRoomStatus($id);
      return view('kostowner.houseroom.manage', compact('data','can','token','id'));
    }

    public function edit($id){
      $data = House::find($id);
      return view('kostowner.houseroom.edit',compact('data'));
    }

    public function createRoom(Request $request,$house_id){
      if (Help::verify($request->key) && $this->getRoomStatus($house_id)) {

      }
    }



    //----------------------------------------------------------------------------------

    private function getHouseStatus(){
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      if ($userpackage != null) {
        $houselimit = $userpackage->Package->house_limit;
        $count = 0;
        foreach ($userpackage->House as $house) {
          $count += 1;
        }
        if ($count < $houselimit) {
          return true;
        }else {
          return false;
        }
      }else {
        return false;
      }
    }

    private function getRoomStatus($house_id){
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      $roomlimit = $userpackage->Package->room_limit;
      $room = Room::where('house_id',$house_id)->count();
      if ($room < $roomlimit) {
        return true;
      }else {
        return false;
      }
    }
}
