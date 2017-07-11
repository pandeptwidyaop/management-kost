<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rental;
use Auth;
use Session;
use Help;

class BillingController extends Controller
{
    public function index()
    {
      $rent = Rental::where('user_id',Auth::user()->id)->where('status','active')->firstOrFail();
      return view('tenant.billing.index', compact('rent'));
    }
}
