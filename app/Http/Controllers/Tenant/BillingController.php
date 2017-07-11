<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rental;
use App\Kostpayment;
use App\Bank;
use Auth;
use Session;
use Help;
use Storage;

class BillingController extends Controller
{
    public function index()
    {
      $rent = Rental::where('user_id',Auth::user()->id)->where('status','active')->firstOrFail();
      $id  = $rent->Room->House->Userpackage->User->id;
      $bank = Bank::where('user_id',$id)->get();
      return view('tenant.billing.index', compact('rent','bank'));
    }

    public function confirm(Request $data,$id)
    {
      if ($data->hasFile('image')) {
        $file = $data->file('image');
        $name = Storage::disk('public')->putFile('kostpayments',$file);
        $pay = Kostpayment::findOrFail($id);
        $pay->image = $name;
        $pay->save();
        Session::flash('alert','Berhasil melakukan konfirmasi pembayaran.');
        return back();
      }
    }
}
