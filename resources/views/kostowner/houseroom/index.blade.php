@extends('layouts.master')
@section('css')

@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        House & Room
        <small>Manage semua rumah beserta kamar.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url('dashboard')}}">Dashboard</a></li>
        <li class="active">House & Room</li>
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
      @elseif (!$can)
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Informasi !</h4>
          Limit Rumah untuk paket anda sudah habis, silakan tingkatkan paket anda untuk membuat rumah baru.
        </div>
      @endif
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">House & Room Management</h3>
        </div>
        <div class="box-body">
          <a href="{{($can) ? Help::url('house-room/create-house?key='.$token) : Help::js()}}" class="btn btn-primary btn-flat">Tambah Rumah</a>
          <hr>
          <div class="row">
            @if ($userpackage != null)
              @foreach ($userpackage->House as $house)
                @php
                  $totalkamar = 0;
                  $kamarkosong = 0;
                  $kamarisi = 0;
                  foreach ($house->Room as $room) {
                    $totalkamar += 1;
                    foreach ($room->Rental as $rent) {
                      if ($rent->status == 'active') {
                        $kamarisi += 1;
                      }
                    }
                  }
                  $kamarkosong = $totalkamar - $kamarisi;
                @endphp
                <div class="col-md-4">
                  <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-green">
                      <div class="widget-user-image">
                        <img class="img-circle" src="{{Help::img('houses/default.png')}}" alt="{{$house->name}}">
                      </div>
                      <h3 class="widget-user-username">{{$house->name}}</h3>
                      <h5 class="widget-user-desc">{{$house->address}}</h5>
                    </div>
                    <div class="box-footer no-padding">
                      <ul class="nav nav-stacked">
                        <li><a href="{{Help::js()}}">Kamar Kosong <span class="pull-right badge bg-blue">{{$kamarkosong}}</span></a></li>
                        <li><a href="{{Help::js()}}">Total Kamar <span class="pull-right badge bg-aqua">{{$totalkamar}}</span></a></li>
                      </ul>
                      <a href="{{Help::url('house-room/'.$house->id.'/manage')}}" class="btn btn-flat btn-block btn-success text-center">Manage</a>
                    </div>
                  </div>
                  <!-- /.widget-user -->
                </div>
              @endforeach
            @endif
          </div>
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
