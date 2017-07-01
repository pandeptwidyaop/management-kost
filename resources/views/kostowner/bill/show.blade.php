@extends('layouts.master')
@section('css')

@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tagihan
        <small>#{{$bill->id}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url('bills')}}">Bills</a></li>
        <li class="active">Tagihan</li>
      </ol>
    </section>
    <section class="invoice">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> PT. Management Kost Indonesia
            <small class="pull-right">Tanggal {{date('d F Y', strtotime($bill->created_at))}}</small>
          </h2>
        </div>
      </div>
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Dari
          <address>
            <strong>PT. Management Kost Indonesia - Bagian Keuangan .</strong><br>
            Jalan Gunung Agung 99A Denpasar Barat<br>
            Denpasar, 81116<br>
            Telpon: (0361) 442233<br>
            Email: mail@managementkost.com
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
          Kepada
          <address>
            <strong>{{$bill->Userpackage->User->name}}</strong><br>
            {{$bill->Userpackage->User->address}}<br>
            Telepon: {{$bill->Userpackage->User->handphone}}<br>
            Email: {{$bill->Userpackage->User->email}}
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
          <b>Tagihan #{{$bill->id}}</b><br>
          <b>Batas Pembayaran :</b> {{date('d/m/Y',strtotime($bill->Userpackage->expired))}}<br>
          <b>Akun ID:</b> {{$bill->Userpackage->User->id}}
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Paket</th>
              <th>Periode</th>
              <th>Deskripsi</th>
              <th>Harga</th>
              <th>Pembayaran</th>
              <th>Total</th>
            </tr>
            </thead>
            <tbody>
              <tr>
                @php
                  $bulan = Carbon\Carbon::parse($bill->start_periode)->diffInMonths(Carbon\Carbon::parse($bill->end_periode));
                @endphp
                <td>{{$bill->Userpackage->Package->name}}</td>
                <td>{{date('d F Y',strtotime($bill->start_periode))}} s/d {{date('d F Y',strtotime($bill->end_periode))}}</td>
                <td>{!!$bill->Userpackage->Package->description!!}</td>
                <td>Rp. {{number_format($bill->price,2,',','.')}}</td>
                <td>{{$bulan}} bulan</td>
                <td>Rp. {{number_format($bulan * $bill->price,2,',','.')}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <p class="lead">Bank Tersedia:</p>
          <img src="{{asset('image/bank/bca.png')}}">
          <img src="{{asset('image/bank/bi.png')}}">
          <img src="{{asset('image/bank/bii.png')}}">
          <img src="{{asset('image/bank/bni.png')}}">
          <img src="{{asset('image/bank/bri.png')}}">
          <img src="{{asset('image/bank/danamon.png')}}">
          <img src="{{asset('image/bank/kualat.png')}}">
          <img src="{{asset('image/bank/mandiri.png')}}">
          <img src="{{asset('image/bank/syariah.png')}}">

        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Batas Pembayaran {{date('d/m/Y',strtotime($bill->Userpackage->expired))}}</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total</th>
                @php
                  $total = $bulan * $bill->price;
                @endphp
                <td>Rp. {{number_format($total,2,',','.')}}</td>
              </tr>
              <tr>
                <th>PPN (10%)</th>
                @php
                  $pajak = ($bulan * $bill->price) / 10;
                @endphp
                <td>Rp. {{number_format($pajak,2,',','.')}}</td>
              </tr>
              <tr>
                <th>Total Bayar</th>
                <td><b>Rp. {{number_format($pajak + $total,2,',','.')}}</b></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="row no-print">
        @if ($bill->image == null)
          <div class="col-xs-12">
            <a href="{{Help::url('packages/changeplan?billing='.$bill->id)}}" class="btn btn-default pull-left">Ubah Paket</a>
            <a href="{{Help::url('bills/'.$bill->id.'/payment')}}" target="popup" onclick="window.open('{{Help::url('bills/'.$bill->id.'/payment')}}','Pembayaran Tagihan','width=600,height=600')" class="btn btn-success pull-right"><i class="fa fa-credit-card" ></i> Lanjutkan ke Pembayaran</a>
            <a href="{{Help::url('bills/'.$bill->id.'/confirm')}}" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-circle-o-notch fa-spin"></i> Konfirmasi Pembayaran</a>
          </div>
        @endif
      </div>
    </section>
    <div class="clearfix"></div>
  </div>
@endsection
@section('js')

@endsection
