@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Payments
        <small>Manajemen pembayaran pengguna manajemen kost.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li class="active"><a href="{{Help::url('payments')}}">Payments</a></li>
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
              <h3 class="box-title">Pembayaran</h3>
            </div>

            <div class="box-body">
              <a class="btn btn-flat btn-primary" href="{{Help::url('payments/create')}}">Buat Tagihan</a>
              <hr>
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th width="5%">Opsi</th>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Periode</th>
                    <th>Total Bulan</th>
                    <th>Tunggakan</th>
                    <th>Image</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $row)
                    <tr>
                      <td>
                        @if ($row->image != null && $row->status == 'not_approved')
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                              <span class="caret"></span>
                              <span>Pilih</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li {!!($row->image == null || $row->status == 'approved') ? 'class="disabled"' : '' !!}><a href="{{Help::js()}}" onclick="approve('{{$row->id}}');">Approve</a></li>
                            </ul>
                          </div>
                        @endif
                      </td>
                      <td>{{$row->id}}</td>
                      <td><a href="{{Help::url('users/'.$row->Userpackage->User->id)}}">{{$row->Userpackage->User->email}}</a></td>
                      <td>{{date('d F Y',strtotime($row->start_periode))}} - {{date('d F Y',strtotime($row->end_periode))}}</td>
                      @php
                        $start = Carbon\Carbon::parse($row->start_periode);
                        $end = Carbon\Carbon::parse($row->end_periode);
                        $bulan = $end->diffInMonths($start);
                      @endphp
                      <td>{{$bulan}} bulan</td>
                      <td>Rp. {{number_format(($row->price * $bulan),2,',','.')}}</td>
                      @php
                        $img = "'".$row->image."'";
                      @endphp
                      <td>{!!($row->image == null) ? '<span class="label label-danger">Tidak Ditemukan</span>' : '<button class="btn btn-xs btn-success" onClick="showImage('.$img.');">Lihat Bukti</button>' !!}</td>
                      <td>
                        {!!($row->status == 'approved') ? '<span class="label label-success">Approved</span>' : '<span class="label label-danger">Not Approved</span>'!!}
                      </td>
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
  <form class="hidden" action="" method="post" id="formApprove">
    {{ csrf_field() }}
  </form>
@endsection
@section('js')
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">
  $(function () {
    $('#table').DataTable({
      order: [[7,"desc"]]
    });
  });

    function showImage(img){
      bootbox.dialog({
        message: '<img src="{{Help::img()}}/'+img+'" class="img-responsive">',
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
