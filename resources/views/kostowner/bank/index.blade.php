@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Banks
        <small>Manage semua rekening bank anda.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li class="active">Banks</li>
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
              <a href="{{Help::js('bank/create')}}" class="btn btn-primary btn-flat" onclick="addBank()">Tambah Bank</a>
              <hr>
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th width="5%">Opsi</th>
                    <th>Bank</th>
                    <th>Nomor</th>
                    <th>AN</th>
                  </tr>
                </thead>
                <tbody>
                  @if ($bank != null)
                    @foreach ($bank as $b)
                      <tr>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                              <span class="caret"></span>
                              <span>Pilih</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="{{Help::url('bank/'.$b->id.'/edit')}}">Edit</a></li>
                              <li class="divider"></li>
                              <li><a href="{{Help::js()}}" onclick="remove('{{$b->id}}')">Hapus</a></li>
                            </ul>
                          </div>
                        </td>
                        <td>{{$b->provider}}</td>
                        <td>{{$b->number}}</td>
                        <td>{{$b->name}}</td>
                      </tr>
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
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="">Tambah Bank</h4>
        </div>
        <div class="modal-body">
          <form action="{{Help::url('bank')}}" method="post">
          {{ csrf_field() }}
            <div class="form-group">
              <label for="">Nama Bank</label>
              <input type="text" class="form-control" id="" placeholder="Nama Bank" name="provider">
            </div>
            <div class="form-group">
              <label for="">Nomor Rekening</label>
              <input type="text" class="form-control" id="" placeholder="Nomor Rekening" name="number">
            </div>
            <div class="form-group">
              <label for="">Nama Di Rekening</label>
              <input type="text" class="form-control" id="" placeholder="Nama" name="name">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <form class="hidden" action="" method="post" id="formDelete">
    <input type="hidden" name="_method" value="delete">
    {{ csrf_field() }}
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

    function addBank() {
      $('#modal').modal('show');
    }

    function remove(id){
      var act = "{{Help::url('bank')}}/"+id;
      bootbox.confirm("Apakah anda yakin ingin menghapus bank ini ?", function(res){
        if (res) {
          $('#formDelete').attr('action', act);
          $('#formDelete').submit();
        }
      });
    }
  </script>
@endsection
