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
                    <th>Paket</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Deadline</th>
                    <th>Total</th>
                    <th>Expired</th>
                    <th>Penagihan Selanjutnya</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $row)
                    @php
                      $notApproved = 0;
                      foreach ($row->Packagepayment as $go) {
                        if ($go->status == 'not_approved') {
                          $notApproved += 1;
                        }
                      }
                    @endphp
                    @if ($notApproved == 0 && $row->expired != null)
                      @php
                        $dead = 0;
                        $ex = Carbon\Carbon::parse($row->expired);
                        $dead = $ex->diffInDays(Carbon\Carbon::now());
                      @endphp
                      <tr>
                        <td>
                          @if ($dead <= 12)
                            <div class="btn-group">
                              <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span>Pilih</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="{{Help::js()}}" onclick="createBilling('{{$row->id}}')">Buat Tagihan</a></li>
                              </ul>
                            </div>
                          @endif
                        </td>
                        <td>{{$row->Package->name}} - Rp. {{number_format($row->Package->price,2,',','.')}}</td>
                        <td>{{$row->User->name}}</td>
                        <td>{{$row->User->email}}</td>
                        <td>
                          @if ($dead <= 12)
                            <span class="label label-danger">{{$dead}} Hari</span>
                          @else
                            <span class="label label-primary">{{$dead}} Hari</span>
                          @endif
                        </td>
                        @php
                          $start = Carbon\Carbon::parse($row->registered);
                          $finish = Carbon\Carbon::parse($row->expired);
                          $total  = $row->Package->price * ($finish->diffInMonths($start));
                        @endphp
                        <td>Rp. {{number_format($total,2,',','.')}}</td>
                        <td>{{date('d F Y', strtotime($row->expired))}}</td>
                        @php
                          $dt = Carbon\Carbon::parse($row->expired);
                        @endphp
                        <td>{{date('d F Y', strtotime($dt->addMonths($finish->diffInMonths($start))))}}</td>
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
  <form class="hidden" action="" method="post" id="formBilling">
    {{ csrf_field() }}
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
          $('#formBilling').attr('action', '{{Help::url('payments/create')}}/'+id);
          $('#formBilling').submit();
        }
      });
    }
  </script>
@endsection
