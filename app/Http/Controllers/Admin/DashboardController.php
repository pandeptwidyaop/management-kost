<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Package;
use App\Packagepayment;
class DashboardController extends Controller
{
    public function index(){
      $users = User::where('type','kost_owner')->count();
      $packages = Package::count();
      $approved = Packagepayment::where('status','approved')->count();
      $notapproved = Packagepayment::where('status','not_approved')->count();
      $paymentNotApproved = Packagepayment::where('status','not_approved')->where('image','<>','null')->limit(5)->get();
      return view('admin.dashboard',compact('users','packages','approved','notapproved','paymentNotApproved'));
    }
}
