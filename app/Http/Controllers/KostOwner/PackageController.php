<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use App\Userpackage;
use App\Packagepayment;
use Carbon\Carbon;
use Auth;
use Help;
use Session;

class PackageController extends Controller
{
    public function index()
    {
      $house = 0;
      $room = 0;
      $key = Help::token();
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      $package = Package::all();
      if ($userpackage != null) {
        foreach ($userpackage->House as $h) {
          $house += 1;
          foreach ($h->Room as $r) {
            $room += 1;
          }
        }
      }
      return view('kostowner.package.index', compact('userpackage','package','house','room','key'));
    }

    public function select(Request $request, $id){
      if (Help::verify($request->key) && $this->getPackageStatus()) {
        $package = Package::findOrFail($id);
        if ($package->price == 0) {
          $userpackage = new Userpackage;
          $userpackage->user_id = Auth::user()->id;
          $userpackage->package_id = $id;
          $userpackage->registered = Carbon::now();
          $userpackage->save();
          Session::flash('alert','Paket berhasil digunakan.');
          return back();
        }else {
          $paket = Help::encode($id);
          $action = Help::encode('new');
          $token = Help::token();
          return redirect(Help::url('packages/pricing?p='.$paket.'&a='.$action.'&k='.$token));
        }
      }else {
        return back();
      }
    }

    public function upgrade(Request $request,$id){
      if (Help::verify($request->key) && $this->getPaymentStatus()) {
        $package_id = Help::encode($id);
        $action = Help::encode('upgrade');
        $token = Help::token();
        return redirect(Help::url('packages/pricing?p='.$package_id.'&a='.$action.'&k='.$token));
      }else {
        Session::flash('alert','Pastikan tidak ada tunggakan pembayaran.');
        return back();
      }
    }

    public function downgrade(Request $request, $id){
      if (Help::verify($request->key) && $this->getPaymentStatus()) {
        $package_id = Help::encode($id);
        $action = Help::encode('downgrade');
        $token = Help::token();
        return redirect(Help::url('packages/pricing?p='.$package_id.'&a='.$action.'&k='.$token));
      }else {
        Session::flash('alert','Pastikan tidak ada tunggakan pembayaran.');
        return back();
      }
    }

    public function pricing(Request $request){
      $key = $request->k;
      if (Help::verify($key)) {
        $id = Help::decode($request->p);
        $paket = $request->p;
        $act = $request->a;
        $package = Package::findOrFail($id);
        return view('kostowner.package.pricing', compact('package','act','paket'));
      }else {
        return 'Token Expired , please contact your Administrator';
      }
    }

    public function newpackage(Request $request){
      $act = Help::decode($request->a);
      $package = Help::decode($request->p);
      $p = Package::findOrFail($package);
      if ($act == 'new') {
        $userpackage = new Userpackage;
        $userpackage->user_id = Auth::user()->id;
        $userpackage->package_id = $p->id;
        $userpackage->registered = Carbon::now();
        $userpackage->expired = Carbon::now()->addDays(2);
        $userpackage->save();
        $payment = new Packagepayment;
        $payment->userpackage_id = $userpackage->id;
        $payment->price = $p->price;
        $payment->start_periode = Carbon::now();
        $payment->end_periode = Carbon::now()->addMonths($request->payment);
        $payment->save();
        Session::flash('alert','Berhasil mendaftar paket baru, silakan melakukan pembayaran sebelum '.date('d F Y',strtotime($userpackage->expired)));
        return redirect(Help::url('bills'));
      }else if ($act == 'upgrade'){
        $userpackage = Userpackage::where('user_id',Auth::user()->id)->firstOrFail();
        $userpackage->package_id = $p->id;
        $userpackage->registered = Carbon::now();
        $userpackage->expired = Carbon::now()->addDays(1);
        $userpackage->save();
        $payment = new Packagepayment;
        $payment->userpackage_id = $userpackage->id;
        $payment->price = $p->price;
        $payment->start_periode = Carbon::now();
        $payment->end_periode = Carbon::now()->addMonths($request->payment);
        $payment->save();
        Session::flash('alert','Berhasil mengupgrade paket. Silakan melakukan pembayaran sebelum '.date('d F Y',strtotime($userpackage->expired)));
        return redirect(Help::url('bills'));
      }elseif ($act == 'downgrade') {
        $userpackage = Userpackage::where('user_id',Auth::user()->id)->firstOrFail();
        $userpackage->package_id = $p->id;
        $userpackage->registered = Carbon::now();
        $userpackage->expired = Carbon::now()->addDays(1);
        $userpackage->save();
        $payment = new Packagepayment;
        $payment->userpackage_id = $userpackage->id;
        $payment->price = $p->price;
        $payment->start_periode = Carbon::now();
        $payment->end_periode = Carbon::now()->addMonths($request->payment);
        $payment->save();
        Session::flash('alert','Berhasil mengdowngrade paket. Silakan melakukan pembayaran sebelum '.date('d F Y',strtotime($userpackage->expired)));
        return redirect(Help::url('bills'));
      }
    }

    public function changeplan(Request $request)
    {
      $bill = Packagepayment::findOrFail($request->billing);
      if ($bill->status != 'approved') {
        return view('kostowner.package.changeplan', compact('bill'));
      }else {
        Session::flash('alert','Tidak bisa merubah billing');
        return redirect(Help::url('bills'));
      }
    }

    public function changebill(Request $request)
    {
      $bill = Packagepayment::findOrFail($request->billing);
      if ($bill->status != 'approved') {
        $bill->end_periode = Carbon::parse($bill->start_periode)->addMonths($request->payment);
        $bill->save();
        return redirect(Help::url('bills/'.$bill->id));
      }else {
        return back();
      }
    }


    private function getPaymentStatus(){
      $r = true;
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      if ($userpackage != null) {
        foreach ($userpackage->Packagepayment as $p) {
          if ($p->status == 'not_approved') {
            $r = false;
          }
        }
      }
      return $r;
    }

    private function getPackageStatus(){
      $r = false;
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      if ($userpackage == null) {
        $r = true;
      }
      return $r;
    }

}
