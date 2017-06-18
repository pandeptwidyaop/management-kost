@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Users
        <small>Manajemen pengguna manajemen kost.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li class="active"><a href="{{Help::url('users')}}">Users</a></li>
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
              <h3 class="box-title">Pengguna</h3>
            </div>

            <div class="box-body">
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th width="5%">Opsi</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Terdaftar</th>
                    <th>Paket</th>
                    <th>Penggunaan</th>
                    <th>Status</th>
                    <th>Tunggakan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $row)
                    <tr>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span>Pilih</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{Help::url('users/'.$row->id)}}">Detail</a></li>
                          </ul>
                        </div>
                      </td>
                      <td>{{$row->name}}</td>
                      <td>{{$row->email}}</td>
                      <td>{{date('d F Y', strtotime($row->created_at))}}</td>
                      <td><span class="label label-success">{{(count($row->Userpackage) > 0) ? $row->Userpackage->Package->name : 'Not Registered'}}</span></td>
                      <td>
                        @php
                          $total = 0;
                          $persen = 0;
                          if (count($row->Userpackage) > 0) {
                            $total = $row->Userpackage->Package->house_limit * $row->Userpackage->Package->room_limit;
                            $totalRoom = 0;
                            foreach ($row->Userpackage->House as $house) {
                              foreach ($house->Room as $room) {
                                $totalRoom += 1;
                              }
                            }
                            $persen = ( $totalRoom / $total) * 100;
                          }
                        @endphp
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar progress-bar-success" style="width: {{$persen}}%"></div>
                        </div>
                        <span class="label label-primary">{{$persen}}%</span>
                      </td>
                      <td>{!!($row->status == 'active') ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Not Active</span>' !!}</td>
                      @php
                        $tunggakan = 0;
                        if (count($row->Userpackage) > 0) {
                          foreach ($row->Userpackage->Packagepayment as $r) {
                            if ($r->status == 'not_approved') {
                              $tunggakan += $r->price;
                            }
                          }
                        }
                      @endphp
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
  <form class="hidden" action="" method="post" id="formGanti">
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
    $('#table').DataTable();
  });
    function deletePackage(id){
      bootbox.confirm("Apakah anda ingin menghapus paket ini ?", function(result){
        if (result) {
          $('#formDelete').attr('action', '{{Help::url('packages')}}/'+id);
          $('#formDelete').submit();
        }
      });
    }
  </script>
@endsection
