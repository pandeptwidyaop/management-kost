<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Help;
use Session;
use Auth;
use App\Rental;
use App\User;

class DashboardController extends Controller
{
    public function index(){
      $rent = Rental::where('user_id',Auth::user()->id)->firstOrFail();
      $userpackage = $rent->Room->House->Userpackage;
      $data = $rent->Room->House;
      return view('tenant.dashboard', compact('userpackage','data','rent'));
    }
}
