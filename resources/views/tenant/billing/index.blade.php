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
              <button type="button" class="btn btn-flat btn-primary" onclick="$('#bank').modal('show')">Daftar Bank</button>
              <hr>
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th>Opsi</th>
                    <th>ID Tagihan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Total Tagihan</th>
                    <th>Periode</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rent->Kostpayment as $bill)
                    @if ($bill->status != 'approved')
                      <tr>
                        @php
                          if ($bill->image == null) {
                            $status = ['type' => 'danger', 'msg' => 'Belum Melakukan Pembayaran'];
                          }elseif ($bill->status == 'not_approved') {
                            $status = ['type' => 'warning', 'msg' => 'Pending'];
                          }elseif ($bill->status == 'approved') {
                            $status = ['type' => 'success','msg' => 'Sukses'];
                          }
                        @endphp
                        <td>
                          @if ($status['type'] == 'danger')
                            <a href="{{Help::js('bills/'.$bill->id)}}" class="btn btn-primary btn-xs btn-flat" onclick="confirm('{{$bill->id}}')">Konfirmasi</a>
                          @endif
                        </td>
                        <td>{{$bill->id}}</td>
                        <td>{{date('d F Y', strtotime($bill->created_at))}}</td>
                        <td>Rp. {{number_format($bill->price,2,',','.')}}</td>
                        <td>{{date('d F Y',strtotime($rent->date))}} - {{date('d F Y',strtotime($bill->date))}}</td>
                        <td><span class="label label-{{$status['type']}}">{{$status['msg']}}</span></td>
                      </tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="">Upload Bukti Pembayaran</h4>
        </div>
        <div class="modal-body">
          <form class="" action="" method="post" id="tableConfirm" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="">Bukti Transfer</label>
              <input type="file" class="form-control" accept="image/*" name="image" required>
              <p class="help-block">Pilih Bukti Pembayaran Anda</p>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Konfirmasi</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="bank" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="">Daftar Bank</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Nama Bank</th>
                <th>Nomor Rekening</th>
                <th>Nama Pemilik</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($bank as $b)
                <tr>
                  <td>{{$b->provider}}</td>
                  <td>{{$b->number}}</td>
                  <td>{{$b->name}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
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

    function confirm(id) {
      var act = '{{Help::url('billings')}}/'+id;
      $('#tableConfirm').attr('action', act);
      $('#confirm').modal('show');
    }
  </script>
@endsection
