<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use User;
use App\Userpackage;
use Auth;

class DashboardController extends Controller
{

    public function index(){
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      $members = $this->members();
      $persentase = $this->percentage();
      $kosong = $this->blankroom();
      $kamar = $this->room();
      $rumah = $this->house();
      return view('kostowner.dashboard',compact('members','persentase','kosong','rumah','kamar','userpackage'));
    }



    // ==================================================================================================

    private function members(){
      $member = 0;
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      if ($userpackage != null) {
        foreach ($userpackage->House as $house) {
          foreach ($house->Room as $room) {
            foreach ($room->Rental as $rental) {
              if ($rental->user_id != null) {
                $member += 1;
              }
            }
          }
        }
      }
      return $member;
    }

    private function percentage(){
      $kamar = 0;
      $space = 0;
      $hasil = 0;
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      if ($userpackage != null) {
        foreach ($userpackage->House as $house) {
          foreach ($house->Room as $room) {
            $kamar += 1;
          }
        }
        $space = $userpackage->Package->house_limit * $userpackage->Package->room_limit;
        $hasil = ($kamar / $space) * 100;
      }
      return $hasil;
    }

    private function blankroom(){
      $member = $this->members();
      $kamar = 0;
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      if ($userpackage != null) {
        foreach ($userpackage->House as $house) {
          foreach ($house->Room as $room) {
            $kamar += 1;
          }
        }
      }
      return $kamar - $member;
    }

    private function room(){
      $room = 0;
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      if ($userpackage != null) {
        foreach ($userpackage->House as $house) {
          foreach ($house->Room as $r) {
            $room += 1;
          }
        }
      }
      return $room;
    }

    private function house(){
      $house = 0;
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      if ($userpackage != null) {
        foreach ($userpackage->House as $house) {
          $house =+ 1;
        }
      }
      return $house;
    }

}
