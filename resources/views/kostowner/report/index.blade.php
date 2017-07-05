@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Report
        <small>Semua laporan fasilitas dan permasalahan pada kamar kost.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li class="active">Report</li>
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
              <h3 class="box-title">Semua laporan</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th width="5%">Opsi</th>
                    <th>Nama</th>
                    <th>Rumah</th>
                    <th>Kamar</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @if ($userpackage != null)
                    @foreach ($userpackage->House as $house)
                      @foreach ($house->Room as $room)
                        @foreach ($room->Rental as $rental)
                          @if ($rental->status == 'active')
                            @foreach ($rental->Report as $r)
                              <tr>
                                <td>
                                  <a href="{{Help::url('reports/'.$r->id)}}" class="btn btn-primary btn-xs btn-flat">Lihat</a>
                                </td>
                                <td>{{$rental->User->name}}</td>
                                <td>{{$house->name}}</td>
                                <td>{{$room->number}}</td>
                                <td>{{date('d F Y',strtotime($r->created_at))}}</td>
                                <td>
                                  {!!($r->read_status == 'read') ? '<span class="label label-success">Sudah Dibaca</span>' : '<span class="label label-danger">Belum Dibaca</span>'!!}
                                </td>
                              </tr>
                            @endforeach
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

    function remove(id){
      var act = "{{Help::url('members')}}/"+id+"/remove";
      bootbox.confirm("Apakah anda yakin ingin mengeluarkan member ini ?", function(res){
        if (res) {
          bootbox.prompt({
            title: "Silakan masukan password anda.",
            inputType: "password",
            callback: function(pass){
              if (pass != null) {
                $('#formDelete').attr('action', act);
                $('#formDelete #password').val(pass);
                $('#formDelete').submit();
              }else {
                bootbox.alert("Silakan masukan password anda!");
              }
            }
          });
        }
      });
    }
  </script>
@endsection
