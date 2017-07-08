@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Payments
        <small>Manajemen pembayaran pengguna kost.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li><a href="{{Help::url('payments')}}">Payments</a></li>
        <li class="active"><a href="{{Help::js()}}">Create</a></li>
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
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Buat Tagihan</h3>
            </div>

            <div class="box-body">
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th width="5%">Opsi</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Rumah</th>
                    <th>Kamar</th>
                    <th>Batas Pembayaran</th>
                    <th>Tagihan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($userpackage->House as $house)
                    @foreach ($house->Room as $room)
                      @foreach ($room->Rental as $rent)
                        @php
                          $app = 0;
                          foreach ($rent->Kostpayment as $pay) {
                            if ($pay->status == 'not_approved') {
                              $app ++;
                            }
                          }
                        @endphp
                        @if ($rent->status == 'active' && $app == 0)
                          @php
                            $now = Carbon\Carbon::now();
                            $until = Carbon\Carbon::parse($rent->date);
                            $batas = Carbon\Carbon::now()->diffInDays($until);
                          @endphp
                          <tr>
                            <td>
                              @if ($batas < 4 || $now >= $until)
                                <div class="btn-group">
                                  <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span>Pilih</span>
                                  </button>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{Help::js()}}" onclick="createBilling('{{$rent->id}}')">Buat Tagihan</a></li>
                                  </ul>
                                </div>
                              @endif
                            </td>
                            <td>{{$rent->User->name}}</td>
                            <td>{{$rent->User->email}}</td>
                            <td>{{$house->name}}</td>
                            <td>{{$room->number}}</td>
                            <td>
                              @if ($now >= $until)
                                <span class="label label-danger">{{$batas}} Hari yang lalu</span>
                              @else
                                <span class="label label-primary">{{$batas}} Hari</span>
                              @endif
                            </td>
                            <td>Rp. {{number_format($room->price,2,',','.')}}</td>
                          </tr>
                        @endif
                      @endforeach
                    @endforeach
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <form class="hidden" action="" method="post" id="formBilling">
    {{ csrf_field() }}
    <input type="hidden" name="rental" value="">
    <input type="hidden" name="bulan" value="">
  </form>
@endsection
@section('js')
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">
  $(function () {
    $('#table').DataTable();
  });
    function createBilling(id){
      bootbox.confirm("Apakah anda ingin menagih pembayaran paket ini ?", function(result){
        if (result) {
          bootbox.prompt("Penagihan untuk berapa bulan ?",function(bulan){
            if (bulan != null) {
              $('#formBilling').attr('action', '{{Help::url('payments/create')}}');
              $('#formBilling input[name="rental"]').val(id);
              $('#formBilling input[name="bulan"]').val(bulan);
              $('#formBilling').submit();
            }
          });
        }
      });
    }
  </script>
@endsection
