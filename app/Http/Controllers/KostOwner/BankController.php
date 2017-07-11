<?php

namespace App\Http\Controllers\KostOwner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bank;
use Auth;
use Session;
use Help;


class BankController extends Controller
{
    public function index()
    {
      $bank = Bank::where('user_id',Auth::user()->id)->get();
      return view('kostowner.bank.index', compact('bank'));
    }

    public function edit($id)
    {
      $data = Bank::findOrFail($id);
      return view('kostowner.bank.edit', compact('data'));
    }

    public function store(Request $request)
    {
      $data = $request->all();
      $data['user_id'] = Auth::user()->id;
      $bank = new Bank;
      $bank->fill($data);
      $bank->save();
      Session::flash('alert','Berhasil menambah data bank.');
      return redirect(Help::url('bank'));
    }

    public function update(Request $request,$id)
    {
      $bank = Bank::findOrFail($id);
      $bank->update($request->all());
      $bank->save();
      Session::flash('alert','Berhasil mengubah data bank');
      return redirect(Help::url('bank'));
    }

    public function destroy($id)
    {
      Bank::destroy($id);
      Session::flash('alert','Berhasil menghapus data bank.');
      return redirect(Help::url('bank'));
    }
}
