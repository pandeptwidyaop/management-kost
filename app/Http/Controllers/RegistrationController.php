<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Help;

class RegistrationController extends Controller
{
    public function index(Request $r){
      $email = Help::decode($r->em);
      $room = Help::decode($r->ro);
      $valid = Help::decode($r->va);
      dd($email);
    }
}
