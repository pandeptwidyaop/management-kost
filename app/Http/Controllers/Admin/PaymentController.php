<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Packagepayment;
use App\Userpackage;
use Auth;
use Session;
use Carbon\Carbon;
use Help;

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

  public function createbilling($id){
    $data = Userpackage::findOrFail($id);
    $payment['userpackage_id'] = $data->id;
    $payment['price'] = $data->Package->price;
    $payment['start_periode'] = $data->expired;
    $start = Carbon::parse($data->registered);
    $end = Carbon::parse($data->expired);
    $bulan = $end->diffInMonths($start);
    $payment['end_periode'] = Carbon::parse($data->expired)->addMonths($bulan);
    $pp = new Packagepayment;
    $pp->fill($payment);
    $pp->save();
    Session::flash('alert','Berhasil membuat tagihan untuk '.$data->User->name);
    return redirect(Help::url('payments/create'));
  }

  public function approve($id){
    $payment = Packagepayment::findOrFail($id);
    $userpackage = Userpackage::findOrFail($payment->userpackage_id);
    $userpackage->registered = $payment->start_periode;
    $userpackage->expired = $payment->end_periode;
    $payment->status = 'approved';
    $userpackage->save();
    $payment->save();
    Session::flash('alert','Berhasil memperbarui paket dan menerima pembayaran');
    return redirect(Help::url('payments'));
  }


}
