<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Help;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Rental;
use App\Http\Requests\Registration;

class RegistrationController extends Controller
{
    public function index(Request $r){
      $email = Help::decode($r->em);
      $room = Help::decode($r->ro);
      $valid = Help::decode($r->va);
      if (Carbon::now() <= Carbon::parse($valid)) {
        if (User::where('email',$email)->count() > 0) {
          $user = User::where('email',$email)->first();
          if (Rent::where('user_id',$user->id)->where('status', 'active')->count() < 1) {
            $this->registerOldUser($user->id,$room);
          }else {
            return redirect('login');
          }
        }else {
          return view('registration',compact('email','room'));
        }
      }
    }

    public function register(Registration $request){
      dd($request->all());
    }

    private function registerOldUser($user,$room){
      $rent = new Rental;
      $rent->user_id = $user;
      $rent->room_id = $room;
      $rent->save();
      return redirect('login');
    }
}
