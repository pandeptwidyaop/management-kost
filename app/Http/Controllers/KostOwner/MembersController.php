<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Help;
use App\Userpackage;
use App\Room;
use Carbon\Carbon;

class MembersController extends Controller
{
    public function index(){
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      $token = Help::token();
      $can = $this->canAddMember();
      return view('kostowner.member.index', compact('userpackage','can','token'));
    }

    public function create(Request $r){
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      if ($this->canAddMember() && Help::verify($r->key)) {
        return view('kostowner.member.create', compact('userpackage'));
      }else {
        return redirect(Help::url('members'));
      }
    }

    public function store(Request $r){
      $email = Help::encode($r->email);
      $room = Help::encode($r->room);
      $date = Help::encode(date('Y-m-d h:m:s',strtotime(Carbon::now()->addDays(1))));
      $string = url('registration?em='.$email.'&ro='.$room.'&va='.$date);
      dd($string);
    }

    //----------------------------------------------------------------------------------

    private function canAddMember(){
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      if ($userpackage != null) {
        $limit = 0;
        $total = 0;
        $limit = $userpackage->Package->house_limit * $userpackage->Package->room_limit;
        foreach ($userpackage->House as $h) {
          foreach ($h->Room as $r) {
            $total += 1;
          }
        }
        return ($total < $limit) ? true : false;
      }else {
        return false;
      }
    }

    public function listroom($id){
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      foreach ($userpackage->House as $h) {
        foreach ($h->Room as $r) {
          foreach ($r->Rental as $rent) {
            if ($rent->status == 'active') {
              $list[] = $rent->Room->id;
            }
          }
        }
      }
      $data = Room::where('house_id',$id)->whereNotIn('id',$list)->get();
      return response()->json($data);
    }
}
