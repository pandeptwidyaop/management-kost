<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Packagepayment;
use App\Userpackage;
use Auth;
use Session;

class PaymentController extends Controller
{

  public function index(){
    $data = Packagepayment::all();
    return view('admin.payment.index',compact('data'));
  }

  public function create(){
    $data = Userpackage::all();
    return view('admin.payment.create',compact('data'));
  }

  public function cretebilling(Request $request, $id){

  }


}
