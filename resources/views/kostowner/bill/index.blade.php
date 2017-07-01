@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Billings
        <small>Data tagihan anda</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li class="active">Billings</li>
      </ol>
    </section>
    <section class="content">
      @if (Session::has('alert'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Informasi !</h4>
          {{Session::get('alert')}}
        </div>
      @endif
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Tagihan Anda</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th>Opsi</th>
                    <th>ID Tagihan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Total Tagihan</th>
                    <th>Batas Pembayaran</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @if ($userpackage != null)
                    @foreach ($userpackage->Packagepayment as $bill)
                      <tr>
                        <td><a href="{{Help::url('bills/'.$bill->id)}}" class="btn btn-primary btn-xs btn-flat">Invoice</a></td>
                        <td>{{$bill->id}}</td>
                        <td>{{date('d F Y', strtotime($bill->created_at))}}</td>
                        @php
                          $month = Carbon\Carbon::parse($bill->start_periode)->diffInMonths(Carbon\Carbon::parse($bill->end_periode));
                        @endphp
                        <td>Rp. {{number_format($month * $bill->price,2,',','.')}}</td>
                        @php
                          if ($bill->image == null) {
                            $status = ['type' => 'danger', 'msg' => 'Belum Melakukan Pembayaran'];
                          }elseif ($bill->status == 'not_approved') {
                            $status = ['type' => 'warning', 'msg' => 'Pending'];
                          }elseif ($bill->status == 'approved') {
                            $status = ['type' => 'success','msg' => 'Sukses'];
                          }
                        @endphp
                        <td><span class="label label-warning">{{date('d/m/Y',strtotime($bill->Userpackage->expired))}}</span></td>
                        <td><span class="label label-{{$status['type']}}">{{$status['msg']}}</span></td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('js')
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <script>
    $(function(){
      $('table').dataTable({
        order: [[1,"desc"]]
      });
    })
  </script>
@endsection
