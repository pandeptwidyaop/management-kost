@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        House & Room
        <small>Manage semua rumah beserta kamar.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li><a href="{{Help::url('house-room')}}">House & Room</a></li>
        <li class="active">Manage</li>
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
                  </table>
                </div>
                <div class="col-md-2">
                  <div class="btn-group">
                    <a class="btn btn-success btn-flat" href="{{Help::url('house-room/'.$id.'/edit')}}">Edit</a>
                    <button class="btn btn-danger btn-flat">Hapus</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Manajemen Pengguna Kamar Kost</h3>
            </div>
            <div class="box-body">
              <a href="{{($can) ? Help::url('house-room/'.$id.'/manage/create-room?key='.$token) : Help::js()}}" class="btn btn-flat btn-primary" >Tambah Kamar</a>
              <hr>
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th width="5%">Opsi</th>
                    <th>Nomor Kamar</th>
                    <th>Price</th>
                    <th>Penyewa</th>
                    <th>Registered</th>
                    <th>Laporan</th>
                    <th>Tunggakan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data->Room as $room)
                    @php
                      $sewa = 'Kosong';
                      $registered = 'Not Registered';
                      $laporan = 0;
                      $tunggakan = 0;
                      foreach ($room->Rental as $rent) {
                        if ($rent->status == 'active') {
                          $sewa = $rent->User;
                          $registered = $rent->created_at;
                        }
                        foreach ($rent->Report as $r) {
                          if ($r->read_status == 'not_read') {
                            $laporan += 1;
                          }
                        }
                        foreach ($rent->Kostpayment as $k) {
                          if ($k->status == 'not_approved') {
                            $tunggakan += $k->price;
                          }
                        }
                      }
                    @endphp
                    <tr>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span>Pilih</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{Help::url('house-room/'.$room->id.'/room-edit')}}">Edit</a></li>
                          </ul>
                        </div>
                      </td>
                      <td>{{$room->number}}</td>
                      <td>Rp. {{number_format($room->price,2,',','.')}}</td>
                      <td><a href="{{Help::url('members/'.$sewa->id)}}">{{$sewa->name}}</a></td>
                      <td>{{date('d F Y',strtotime($registered))}}</td>
                      <td>{{$laporan}}</td>
                      <td>Rp. {{number_format($tunggakan,2,',','.')}}</td>
                    </tr>
                  @endforeach
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
  <script type="text/javascript">
    $(function(){
        $('#table').dataTable();
    });
  </script>
@endsection
