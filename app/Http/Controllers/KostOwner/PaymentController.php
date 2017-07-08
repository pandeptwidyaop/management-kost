<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kostpayment;
use App\Rental;
use App\Room;
use Auth;
use Help;
use Carbon\Carbon;
use App\Userpackage;
use Session;

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

    public function approve($id)
    {
      $pay = Kostpayment::findOrFail($id);
      $date = $pay->date;
      $pay->status = 'approved';
      $rent = Rental::find($pay->rental_id);
      $rent->date = $date;
      $rent->save();
      $pay->save();
      Session::flash('alert','Berhasil melakukan approve pembayaran');
      return back();
    }

    public function create()
    {
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      return view('kostowner.payment.create', compact('userpackage'));
    }

    public function store(Request $request)
    {
      $rental = Rental::findOrFail($request->rental);
      $price = $request->bulan * $rental->Room->price;
      $date = Carbon::parse($rental->date)->addMonths($request->bulan);
      $pay = new Kostpayment;
      $pay->date = $date;
      $pay->price = $price;
      $pay->rental_id = $rental->id;
      $pay->save();
      Session::flash('alert','Berhasil membuat penagihan.');
      return back();
    }

    public function destroy($id)
    {
      Kostpayment::destroy($id);
      Session::flash('alert','Berhasil menghapus penagihan.');
      return back();
    }
}
