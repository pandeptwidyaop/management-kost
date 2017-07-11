<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Rental;
use Auth;
use Help;
use App\Report;
use App\Reportpicture;
use Storage;

class ReportController extends Controller
{
    public function index()
    {
      $id = Rental::where('status','active')->where('user_id',Auth::user()->id)->firstOrFail();
      $data = Report::where('rental_id',$id->id)->get();
      return view('tenant.report.index', compact('data'));
    }

    public function store(Request $data)
    {
      $r = Rental::where('status','active')->where('user_id',Auth::user()->id)->firstOrFail();
      $report = new Report;
      $report->message = $data->message;
      $report->rental_id = $r->id;
      $report->save();
      if ($data->hasFile('picture')) {
        foreach ($data->picture as $key => $value) {
          $p = new Reportpicture;
          $p->report_id = $report->id;
          //$name = 'reportpictures/'.$value->hashName();
          $name = Storage::disk('public')->putFile('reportpictures',$value);
          $p->url = $name;
          $p->save();
        }
      }
      Session::flash('alert','Berhasil membuat laporan');
      return back();
    }
}
