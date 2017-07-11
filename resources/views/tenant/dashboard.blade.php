@extends('layouts.master')
@section('css')

@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="box">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                @php
                  $act = 0;
                @endphp
                @foreach ($data->Housepicture as $p)
                  <li data-target="#carousel-example-generic" data-slide-to="{{$act}}" class="{{($act == 0) ? 'active' : ''}}"></li>
                  @php
                    $act +=1;
                  @endphp
                @endforeach
              </ol>
              <div class="carousel-inner">
                @php
                  $act = 0;
                @endphp
                @foreach ($data->Housepicture as $p)
                  <div class="item {{($act == 0) ? 'active' : ''}}">
                    <img src="{{Help::img($p->url)}}" alt="{{$p->House->name}}" style="width:100%">
                    <div class="carousel-caption">
                      {{$p->House->name}}
                    </div>
                  </div>
                  @php
                    $act += 1;
                  @endphp
                @endforeach
              </div>
              <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="fa fa-angle-left"></span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="fa fa-angle-right"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="box box-with-border">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-10">
                    <table class="table">
                      <tr>
                        <td><b>Nama Rumah</b></td>
                        <td>{{$data->name}}</td>
                      </tr>
                      <tr>
                        <td><b>Alamat</b></td>
                        <td>{{$data->address}}</td>
                      </tr>
                      <tr>
                        <td><b>Nomor Kamar</b></td>
                        <td>{{$rent->Room->number}}</td>
                      </tr>
                      <tr>
                        <td><b>Harga Perbulan</b></td>
                        <td>Rp. {{number_format($rent->Room->price,2,',','.')}}</td>
                      </tr>
                      <tr>
                        <td><b>Berlaku Sampai</b></td>
                        <td>{{date('d F Y',strtotime($rent->date))}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('js')

@endsection
