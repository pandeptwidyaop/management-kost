<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use Help;
use App\Userpackage;
use App\Room;
use App\Rental;
use Carbon\Carbon;
use App\Mail\MemberRegistration as Reg;
use Mail;
use App\User;


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
      $find = User::where('email',$r->email)->count();
      if ($find == 0) {
        $email = Help::encode($r->email);
        $room = Help::encode($r->room);
        $date = Help::encode(date('Y-m-d h:m:s',strtotime(Carbon::now()->addDays(1))));
        $string = url('registration?em='.$email.'&ro='.$room.'&va='.$date);
        Mail::to($r->email)->send(new Reg($string));
        Session::flash('alert','Email terkirim ke '.$r->email.' . Tautan untuk melengkapi registrasi sudah terlampir di email.');
        return redirect(Help::url('members'));
      }else {
        return back();
      }
    }

    public function changeRoomMember($id){
      $rental = Rental::findOrFail($id);
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->firstOrFail();
      return view('kostowner.member.changeroom',compact('rental','userpackage','id'));
    }

    public function change(Request $r,$rent_id){
      $rent = Rental::findOrFail($rent_id);
      $rent->room_id = $r->room;
      $rent->save();
      Session::flash('alert','Berhasil mengubah kamar.');
      return redirect(Help::url('members'));
    }

    public function remove(Request $r, $id){
      if (Hash::check($r->access,Auth::user()->password)) {
        $rent = Rental::findOrFail($id);
        $rent->status = 'not_active';
        $rent->save();
        Session::flash('alert','Berhasil mengeluarkan member');
      }
      return redirect(Help::url('members'));
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
      $list = array();
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
