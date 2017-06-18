@extends('layouts.master')
@section('css')

@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Packages
        <small>Manajemen paket anda untuk pengguna.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li class="active"><a href="{{Help::url('packages')}}">Packages</a></li>
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
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Paket Manajemen Kost</h3>
            </div>

            <div class="box-body">
              <a class="btn btn-flat btn-primary" href="{{Help::url('packages/create')}}">Tambah Paket</a>
              <hr>
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Total Rumah</th>
                  <th>Kamar Per Rumah</th>
                  <th style="width: 40px">Option</th>
                </tr>
                @foreach ($data as $row)
                  <tr>
                    <th>-</th>
                    <th>{{$row->name}}</th>
                    <th>Rp. {{number_format($row->price,2,',','.')}}</th>
                    <th><span class="label label-success">{{$row->house_limit}}</span></th>
                    <th><span class="label label-danger">{{$row->room_limit}}</span></th>
                    <th>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span>Pilih</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{{Help::url('packages/'.$row->id.'/edit')}}">Edit</a></li>
                          <li class="divider"></li>
                          <li><a href="javascript:void(0)" onclick="deletePackage('{{$row->id}}')">Hapus</a></li>
                        </ul>
                      </div>
                    </th>
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <form class="hidden" action="" method="post" id="formDelete">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="delete">
  </form>
@endsection
@section('js')
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
  <script type="text/javascript">
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
