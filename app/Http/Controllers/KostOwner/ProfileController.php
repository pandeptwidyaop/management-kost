<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Session;
use Help;
use Image;
use Storage;

class ProfileController extends Controller
{
    public function index(){
      $data = User::findOrFail(Auth::user()->id);
      return view('admin.profile.index',compact('data'));
    }

    public function update(Request $request){
      $data = $request->all();
      $user = User::find(Auth::user()->id);
      $user->update($data);
      Session::flash('alert','Berhasil memperbarui profile');
      return redirect(Help::url('profile'));
    }

    public function changeimage(Request $request){
      $u = User::findOrFail(Auth::user()->id);
      if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $img = Image::make($file)->fit(500,500, function($const){
          $const->upsize();
        });
        $filename = 'avatars/'.$file->hashName();
        Storage::disk('public')->put($filename,$img->stream());
        $u->avatar = $filename;
        $u->save();
        Session::flash('alert','Berhasil memperbarui avatar anda.');
      }
      return redirect(Help::url('profile'));
    }

    public function changepassword(Request $request){
      $u = User::find(Auth::user()->id);
      $u->password = bcrypt($request->password);
      $u->save();
      Session::flash('alert','Berhasil mengubah password.');
      return redirect(Help::url('profile'));
    }
}
