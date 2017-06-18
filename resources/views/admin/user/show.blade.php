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
        <li><a href="{{Help::url('users')}}">Users</a></li>
        <li class="active"><a href=""></a>{{$data->name}}</li>
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
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Detail : {{$data->name}}</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                  <table class="table table-bordered">
                    <tr>
                      <td>Nama</td>
                      <td>{{$data->name}}</td>
                    </tr>
                    <tr>
                      <td>No KTP</td>
                      <td>{{$data->id_number}}</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>{{$data->email}}</td>
                    </tr>
                    <tr>
                      <td>Handphone</td>
                      <td>{{$data->handphone}}</td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>{{$data->address}}</td>
                    </tr>
                    <tr>
                      <td>Paket</td>
                      <td><span class="label label-success">{{(count($data->Userpackage) > 0) ? $data->Userpackage->Package->name : 'Not Registered'}}</span></td>
                    </tr>
                    <tr>
                      <td>Jumlah Rumah</td>
                      <td>{{(count($data->Userpackage) > 0) ? count($data->Userpackage->House) : 'Not Available'}}</td>
                    </tr>
                    <tr>
                      @php
                        $t = 0;
                        if (count($data->Userpackage) > 0) {
                          foreach ($data->Userpackage->House as $h) {
                            foreach ($h->Room as $r) {
                              $t += 1;
                            }
                          }
                        }
                      @endphp
                      <td>Jumlah Kamar</td>
                      <td>{{$t}}</td>
                    </tr>
                    <tr>
                      <td>Jumlah Tunggakan</td>
                      @php
                        $tu = 0;
                        if (count($data->Userpackage) > 0) {
                          foreach ($data->Userpackage->Packagepayment as $row) {
                            if ($row->status == 'not_approved') {
                              $tu += $row->price;
                            }
                          }
                        }
                      @endphp
                      <td>Rp. {{number_format($tu,2,',','.')}}</td>
                    </tr>
                  </table>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <img class="img-responsive" src="{{Help::img($data->avatar)}}" alt="{{$data->name}}">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Pengguna Kost (Anak Kost)</h3>
            </div>

            <div class="box-body">
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Rumah</th>
                    <th>Kamar</th>
                    <th>Terdaftar</th>
                    <th>Tunggakan</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($data->Userpackage) > 0)
                    @foreach ($data->Userpackage->House as $h)
                      @foreach ($h->Room as $r)
                        @foreach ($r->Rental as $rent)
                          @if ($rent->status == 'active')
                            @php
                              $tt = 0;
                              foreach ($rent->Kostpayment as $r) {
                                if ($r->status == 'not_approved') {
                                  $tt +=1;
                                }
                              }
                            @endphp
                            <tr>
                              <td>{{$rent->User->name}}</td>
                              <td>{{$rent->User->email}}</td>
                              <td><span class="label label-primary">{{$rent->Room->House->name}}</span></td>
                              <td><span class="label label-warning">{{$rent->Room->number}}</span></td>
                              <td>{{date('d F Y',strtotime($rent->created_at))}}</td>
                              <td><span class="label label-danger">{{$tt}}</span></td>
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
