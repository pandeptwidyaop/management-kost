<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Packagepayment;
use App\Userpackage;
use Auth;
use Help;

class BillController extends Controller
{
    public function index()
    {
      $userpackage = Userpackage::where('user_id', Auth::user()->id)->first();
      return view('kostowner.bill.index', compact('userpackage'));
    }
}
