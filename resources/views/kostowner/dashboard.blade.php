@extends('layouts.master')
@section('css')

@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Manage semua aktivitas pada usaha anda.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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
      @if ($userpackage == null)
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Informasi !</h4>
          Silakan daftarkan paket sebelum menggunakan manajemen rumah dan kamar.
        </div>
      @endif
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="progress">
            <div class="progress-bar progress-bar-green progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{$persentase}}%">
              <span class="">{{number_format($persentase,0,',','.')}}% Terpakai</span>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$members}}</h3>

              <p>Total Kost Member</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{Help::url('members')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$kosong}}</h3>

              <p>Total Kamar Kosong</p>
            </div>
            <div class="icon">
              <i class="ion ion-unlocked"></i>
            </div>
            <a href="{{Help::url('house-room')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$rumah}}</h3>

              <p>Total Rumah</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-home"></i>
            </div>
            <a href="{{Help::url('house-room')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$kamar}}</h3>

              <p>Total Kamar</p>
            </div>
            <div class="icon">
              <i class="ion ion-grid"></i>
            </div>
            <a href="{{Help::url('house-room')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          Start creating your amazing application!
        </div>
        <div class="box-footer">
          Footer
        </div>
      </div>
    </section>
  </div>
@endsection
@section('js')

@endsection
