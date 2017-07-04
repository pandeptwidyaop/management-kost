<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kostpayment;
use Auth;
use Help;
use App\Userpackage;

class PaymentController extends Controller
{

    public function __construct()
    {
      $this->middleware('grant');
    }
    
    public function index(){
      $userpackage = Userpackage::where('user_id', Auth::user()->id)->first();
      return view('kostowner.payment.index', compact('userpackage'));
    }
}
