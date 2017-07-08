@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Payments
        <small>Manajemen pembayaran pengguna anak kost.</small>
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
                    <th>Nama</th>
                    <th>Rumah</th>
                    <th>Kamar</th>
                    <th>Pembayaran</th>
                    <th>Tunggakan</th>
                    <th>Image</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($userpackage->House as $house)
                    @foreach ($house->room as $room)
                      @foreach ($room->Rental as $rent)
                        @if ($rent->status == 'active')
                          @foreach ($rent->Kostpayment as $data)
                            <tr>
                              <td>
                                @if ($data->status == 'not_approved')
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                      <span class="caret"></span>
                                      <span>Pilih</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                      @if ($data->image != null && $data->status != 'approved')
                                        <li {!!($data->image == null || $data->status == 'approved') ? 'class="disabled"' : '' !!}><a href="{{Help::js()}}" onclick="approve('{{$data->id}}');">Approve</a></li>
                                      @endif
                                      <li class="divider"></li>
                                      <li><a href="{{Help::js()}}" onclick="destroy('{{$data->id}}')">Hapus</a></li>
                                    </ul>
                                  </div>
                                @endif
                              </td>
                              <td>{{$data->id}}</td>
                              <td>{{$rent->User->name}}</td>
                              <td>{{$house->name}}</td>
                              <td>{{$room->number}}</td>
                              <td>{{date('d F Y',strtotime($rent->date))}} - {{date('d F Y',strtotime($data->date))}}</td>
                              <td>Rp. {{number_format($data->price,2,',','.')}}</td>
                              <td>
                                @if ($data->image != null)
                                  <button type="button" class="btn btn-xs btn-success" onclick="showImage('{{Help::img($data->image)}}')">Open Image</button>
                                @else
                                  <span class="label label-danger">Not Available</span>
                                @endif
                              </td>
                              <td>
                                @if ($data->status == 'approved')
                                  <span class="label label-success">Approved</span>
                                @else
                                  <span class="label label-warning">Not Approved</span>
                                @endif
                              </td>
                            </tr>
                          @endforeach
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
  <form class="hidden" action="" method="post" id="formApprove">
    {{ csrf_field() }}
  </form>
  <form class="hidden" action="" method="post" id="del">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="delete">
  </form>
@endsection
@section('js')
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">
  $(function () {
    $('#table').DataTable({
      order: [[8,"desc"]]
    });
  });

    function showImage(img){
      bootbox.dialog({
        message: '<img src="'+img+'" class="img-responsive">',
        closeButton: true,
        size: 'large'
      });
    }

    function approve(id){
      bootbox.confirm("Apakah anda ingin menerima pembayaran ini ?", function(result){
        if (result) {
          $('#formApprove').attr('action', '{{Help::url('payments/approve')}}/'+id);
          $('#formApprove').submit();
        }
      });
    }

    function destroy(id) {
      bootbox.confirm("Apakah anda yakin untuk menghapus penagihan ini ?", function(res){
        if (res) {
          $('#del').attr('action', '{{Help::url('payments')}}/'+id);
          $('#del').submit();
        }
      });
    }
  </script>
@endsection
