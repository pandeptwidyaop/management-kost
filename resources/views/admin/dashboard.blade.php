@extends('layouts.master')
@section('css')

@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Selamat datang <strong>{{Auth::user()->name}}</strong> di Management Kost</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{Help::url()}}">Dashboard</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$users}}</h3>

              <p>Total Pengguna</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{Help::url('users')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$packages}}</h3>

              <p>Total Paket</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-cloud"></i>
            </div>
            <a href="{{Help::url('packages')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$approved}}</h3>

              <p>Pembayaran Diterima</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-checkmark-outline"></i>
            </div>
            <a href="{{Help::url('payments')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$notapproved}}</h3>

              <p>Pembayaran Belum Diterima</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-close-outline"></i>
            </div>
            <a href="{{Help::url('payments')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Pembayaran Belum Diterima</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nama</th>
                  <th>Tagihan</th>
                  <th>Bukti</th>
                  <th style="width: 40px">Option</th>
                </tr>
                @foreach ($paymentNotApproved as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->Userpackage->User->name}}</td>
                    @php
                      $month = Carbon\Carbon::parse($row->start_periode)->diffInMonths(Carbon\Carbon::parse($row->end_periode));
                    @endphp
                    <td>Rp. {{number_format($row->price * $month,2,'.',',')}}</td>
                    <th><button type="button" class="btn btn-flat btn-xs btn-primary" onclick="showImage('{{Help::img($row->image)}}')">Bukti</button></th>
                    <td><button type="button" class="btn btn-flat btn-xs btn-success" onclick="approve('{{$row->id}}')">Approve</button></td>
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <form class="hidden" action="" method="post" id="formApprove">
    {{ csrf_field() }}
  </form>
@endsection
@section('js')
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
  <script type="text/javascript">
  function showImage(img){
    bootbox.dialog({
      message: '<img src="'+img+'" class="img-responsive">',
      closeButton: true,
      size: 'large'
    });
  }

  function approve(id){
    bootbox.confirm("Apakah anda ingin menerima pembayarana ini ?", function(result){
      if (result) {
        $('#formApprove').attr('action', '{{Help::url('payments/approve')}}/'+id);
        $('#formApprove').submit();
      }
    });
  }
  </script>
@endsection
