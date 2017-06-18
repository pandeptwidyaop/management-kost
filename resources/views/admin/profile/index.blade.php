@extends('layouts.master')
@section('css')

@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Profile
        <small>Manajemen profile anda.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li><a href="{{Help::url('profile')}}">Profile</a></li>
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
              <h3 class="box-title">Ubah Profile Anda</h3>
            </div>

            <div class="box-body">
              <div class="row">
                <div class="col-md-8 col-sm-8">
                  <form role="form" action="{{Help::url('profile')}}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control " value="{{$data->email}}" disabled>
                      </div>
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="Nama anda" name="name" value="{{$data->name}}">
                      </div>
                      <div class="form-group">
                        <label>Handphone</label>
                        <input type="text" class="form-control" placeholder="handphone anda" name="handphone" value="{{$data->handphone}}">
                      </div>
                      <div class="form-group">
                        <label>Nomor Identitas</label>
                        <input type="number" class="form-control" placeholder="Harga Paket" name="id_number" value="{{$data->id_number}}">
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="address" value="{{$data->address}}">
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                      <a href="{{Help::js()}}" class="btn btn-warning btn-flat pull-left" onclick="updatePassword();">Ganti Password</a>
                    </div>
                  </form>
                </div>
                <div class="col-md-4 col-sm-4">
                  <div class="box-body">
                    <img src="{{Help::img($data->avatar)}}" alt="{{$data->name}}" class="img-responsive">
                  </div>
                  <div class="box-footer">
                    <button type="button" class="btn btn-flat btn-primary" onclick="changeimage()">Ganti Avatar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <form class="hidden" action="{{Help::url('profile/password')}}" method="post" id="formPassword">
    {{ csrf_field() }}
    <input type="hidden" name="password" value="" id="password">
  </form>

  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{Help::url('profile/avatar')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <input type="file" name="avatar" class="form-control-file" accept="image/jpeg">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
  <script type="text/javascript">
    function updatePassword(){
      bootbox.prompt({
        title: 'Masukan password anda.',
        inputType: 'password',
        size: 'small',
        callback: function(result){
          if (result != null ) {
            bootbox.prompt({
              title: 'Masukan kembali password anda.',
              inputType: 'password',
              size: 'small',
              callback: function(password){
                if (password != null) {
                  if (result == password) {
                    $('#formPassword #password').val(password);
                    $('#formPassword').submit();
                  }else {
                    bootbox.alert("Password tidak sama. Silakan ulangi !");
                  }
                }
              }
            });
          }
        }
      });
    }

    function changeimage(){
      $('#myModal').modal('show');
    }
  </script>
@endsection
