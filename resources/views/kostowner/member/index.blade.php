@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Members
        <small>Manage semua member atau anak kost di rumah anda.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li class="active">Members</li>
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
              <h3 class="box-title">Manajemen Pengguna Kamar Kost</h3>
            </div>
            <div class="box-body">
              <a href="{{($can) ? Help::url('members/create?key='.$token) : Help::js()}}" class="btn btn-primary btn-flat">Tambah Member</a>
              <hr>
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th width="5%">Opsi</th>
                    <th>Nama</th>
                    <th>Rumah</th>
                    <th>Nomor Kamar</th>
                    <th>Registered</th>
                    <th>Laporan</th>
                    <th>Tunggakan</th>
                  </tr>
                </thead>
                <tbody>
                @if ($userpackage != null)
                  @foreach ($userpackage->House as $house)
                    @foreach ($house->Room as $room)
                      @foreach ($room->Rental as $rent)
                        @if ($rent->status == 'active')
                          @php
                            $laporan = 0;
                            $tunggakan = 0;
                            foreach ($rent->Report as $report) {
                              if ($report->status == 'not_read') {
                                $laporan += 1;
                              }
                            }
                            foreach ($rent->Kostpayment as $pay) {
                              if ($pay->status == 'not_approved') {
                                $tunggakan += $pay->price;
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
                                  <li><a href="{{Help::url('')}}">Pindah Kamar</a></li>
                                  <li><a href="{{Help::js()}}">Tukar Kamar</a></li>
                                  <li class="divider"></li>
                                  <li><a href="{{Help::js()}}" onclick="remove('{{$rent->id}}')">Keluarkan</a></li>
                                </ul>
                              </div>
                            </td>
                            <td>{{$rent->User->name}}</td>
                            <td>{{$house->name}}</td>
                            <td>{{$room->number}}</td>
                            <td>{{date('d F Y', strtotime($rent->created_at))}}</td>
                            <td>{{$laporan}}</td>
                            <td>Rp. {{number_format($tunggakan,2,',','.')}}</td>
                          </tr>
                        @endif
                      @endforeach
                    @endforeach
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
  <form class="hidden" action="" method="post" id="formDelete">
    <input type="hidden" name="_method" value="delete">
    {{ csrf_field() }}
    <input type="hidden" name="access" value="" id="password">
  </form>
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
