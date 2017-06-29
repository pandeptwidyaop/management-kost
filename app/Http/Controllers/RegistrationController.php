<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
          if (Rental::where('user_id',$user->id)->where('status', 'active')->count() < 1) {
            $this->registerOldUser($user->id,$room,$user->id);
          }else {
            return redirect('login');
          }
        }else {
          return view('registration',compact('email','room'));
        }
      }else {
        return 'Expired Token';
      }
    }

    public function register(Registration $request){
      $data = $request->all();
      $data['type'] = 'tenant';
      $data['password'] = Hash::make($request->password);
      $user = new User;
      $user->fill($data);
      $user->save();
      $rent = new Rental;
      $rent->user_id = $user->id;
      $rent->room_id = $request->ro;
      $rent->save();
      if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return redirect()->intended('anak-kost');
      }else {
        return 'Something error, pelase contact your administrator.';
      }
    }

    private function registerOldUser($user,$room,$user_id){
      $rent = new Rental;
      $rent->user_id = $user;
      $rent->room_id = $room;
      $rent->save();
      $user = User::findOrFail($user_id);
      if (Auth::attempt(['email' => $user->email])) {
        return redirect('anak-kost');
      }
      return redirect('login');
    }
}
