<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Packagepayment;
use App\Userpackage;
use Carbon\Carbon;
use Auth;
use Help;

class BillController extends Controller
{
    public function index()
    {
      $userpackage = Userpackage::where('user_id', Auth::user()->id)->first();
      return view('kostowner.bill.index', compact('userpackage'));
    }

    public function show($id)
    {
      $bill = Packagepayment::findOrFail($id);
      return view('kostowner.bill.show', compact('bill'));
    }

    public function payment($id)
    {
      $pay = Packagepayment::findOrFail($id);
      $bulan = Carbon::parse($pay->start_periode)->diffInMonths(Carbon::parse($pay->end_periode));
      $total = (($bulan * $pay->price) / 10) + ($bulan * $pay->price);
      $total = number_format($total,2,',','.');
      return view('kostowner.bill.pay', compact('pay','total'));
    }


    public function getListOfBank()
    {
      $data = [
        [
          'bank' => 'BCA',
          'name' => 'PT. MANAGEMENT KOST',
          'number' => 544234543,
          'logo' => asset('image/bca.png')
        ],
        [
          'bank' => 'BI',
          'name' => 'PT. MANAGEMENT KOST',
          'number' => 100003222532,
          'logo' => asset('image/bi.png')
        ],
        [
          'bank' => 'BII',
          'name' => 'PT. MANAGEMENT KOST',
          'number' => 677121003435352,
          'logo' => asset('image/bii.png')
        ],
        [
          'bank' => 'BJB',
          'name' => 'PT. MANAGEMENT KOST',
          'number' => 544234543,
          'logo' => asset('image/bjb.png')
        ],
        [
          'bank' => 'BNI',
          'name' => 'PT. MANAGEMENT KOST',
          'number' => 900001245732,
          'logo' => asset('image/bni.png')
        ],
        [
          'bank' => 'BRI',
          'name' => 'PT. MANAGEMENT KOST',
          'number' => 100021356967234,
          'logo' => asset('image/bca.png')
        ],
        [
          'bank' => 'DANAMON',
          'name' => 'PT. MANAGEMENT KOST',
          'number' => 20013356437,
          'logo' => asset('image/danamon.png')
        ],
        [
          'bank' => 'MUAMALAT',
          'name' => 'PT. MANAGEMENT KOST',
          'number' => 45449523342,
          'logo' => asset('image/kualat.png')
        ],
        [
          'bank' => 'MANDIRI',
          'name' => 'PT. MANAGEMENT KOST',
          'number' => 900012352398932432,
          'logo' => asset('image/mandiri.png')
        ],
        [
          'bank' => 'Mandiri Syariah',
          'name' => 'PT. MANAGEMENT KOST',
          'number' => 80000423284,
          'logo' => asset('image/syariah.png')
        ],
      ];

      return response()->json($data);
    }
}
