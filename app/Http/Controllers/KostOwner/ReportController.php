<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use App\Userpackage;
use Auth;
use Session;
use Help;

class ReportController extends Controller
{
    public function __construct()
    {
      $this->middleware('grant');
    }

    public function index()
    {
      $userpackage = Userpackage::where('user_id',Auth::user()->id)->first();
      return view('kostowner.report.index', compact('userpackage'));
    }

    public function show($id)
    {
      $data = Report::findOrFail($id);
      $data->read_status = 'read';
      $data->save();
      return view('kostowner.report.show', compact('data'));
    }
}
