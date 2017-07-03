<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use Carbon\Carbon;
class ApiController extends Controller
{
    public function getpackageperiode(Request $data){
      $now = Carbon::now();
      $exp = Carbon::now()->addMonths($data->month);
      $return = date('d F Y',strtotime($now)).' sampai '.date('d F Y',strtotime($exp));
      return response()->json($return);
    }
}
