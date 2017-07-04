@extends('layouts.master')
@section('css')

@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Packages
        <small>Sesuaikan paket berdasarkan kebutuhan anda.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li class="active">Package</li>
      </ol>
    </section>
    <section class="content">
      <div class="alert alert-info">
        <h4><i class="icon fa fa-check"></i> Informasi !</h4>
        <p>Paket Anda saat ini adalah : Paket <b>{{($userpackage != null) ? $userpackage->Package->name : 'BELUM TERDAFTAR'}}</b></p>
        @php
          $periode = '-';
          if ($userpackage != null) {
            if ($userpackage->expired != null) {
              $periode = date('d/m/Y',strtotime($userpackage->registered)) .' - '. date('d/m/Y',strtotime($userpackage->expired));
            }else {
              $periode = date('d/m/Y',strtotime($userpackage->registered)) .' - ~';
            }
          }
        @endphp
        <p>Periode Pembayaran : {{$periode}}</p>
        @php
          $bulan = 0;
          if ($userpackage != null) {
            $bulan = Carbon\Carbon::parse($userpackage->registered)->diffInMonths(Carbon\Carbon::parse($userpackage->expired));
          }
        @endphp
        <p>Tipe Pembayaran : Setiap {{$bulan}} bulan.</p>
      </div>
      @if (Session::has('alert'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Informasi !</h4>
          {{Session::get('alert')}}
        </div>
      @endif
      <div class="row">
        @foreach ($package as $p)
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header with-border text-center">
                <h3 class="box-title">Paket <b>{{$p->name}}</b></h3>
              </div>
              <div class="box-body">
                <div class="text-center">
                  <h1>Rp. {{number_format($p->price,0,',','.')}} / Bulan</h1>

                  <br>
                </div>
                {!!$p->description!!}
                @if ($userpackage == null)
                  <a href="{{Help::url('packages/'.$p->id.'/select?key='.$key)}}" class="btn btn-success btn-block btn-flat">
                    Gunakan Paket Ini
                  </a>
                @elseif ($userpackage->package_id == $p->id)
                  <a href="{{Help::url('packages/mypackage')}}" class="btn btn-block btn-primary btn-flat">
                    Paket Anda Saat Ini
                  </a>
                @elseif ($userpackage->Package->price < $p->price && $room < ($p->house_limit * $p->room_limit))
                  <a href="{{Help::url('packages/'.$p->id.'/upgrade?key='.$key)}}" class="btn btn-flat btn-block btn-success">
                    Upgrade Ke Paket Ini
                  </a>
                @elseif ($house <= $p->house_limit && $room <= $p->room_limit && $userpackage->Package->price > $p->price)
                  <a href="{{Help::url('packages/'.$p->id.'/downgrade?key='.$key)}}" class="btn btn-default btn-block btn-flat">
                    Downgrade Ke Paket Ini
                  </a>
                @else
                  <button type="button" class="btn btn-warning btn-block btn-flat">
                    Tidak Bisa Menggunakan Paket Ini
                  </button>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  </div>

@endsection
@section('js')
  <script type="text/javascript">

  </script>
@endsection
