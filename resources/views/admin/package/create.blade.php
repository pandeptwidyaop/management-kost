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
        <li><a href="{{Help::url('packages')}}">Packages</a></li>
        <li class="active"><a href="{{Help::url('packages/create')}}"></a>Create</li>
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
              <h3 class="box-title">Tambah Paket Manajemen Kost</h3>
            </div>

            <div class="box-body">
              <form role="form" action="{{Help::url('packages')}}" method="post">
                {{ csrf_field() }}
                <div class="box-body">
                  <div class="form-group">
                    <label>Nama Paket</label>
                    <input type="text" class="form-control" placeholder="Nama Paket" name="name" value="{{old('name')}}">
                  </div>
                  <div class="form-group">
                    <label>Limit Rumah</label>
                    <input type="number" class="form-control" placeholder="Jumlah Rumah" name="house_limit" value="{{old('limit_house')}}">
                  </div>
                  <div class="form-group">
                    <label>Limit Kamar Per Rumah</label>
                    <input type="number" class="form-control" placeholder="Jumlah Kamar" name="room_limit" value="{{old('limit_room')}}">
                  </div>
                  <div class="form-group">
                    <label>Harga Paket Per Bulan</label>
                    <input type="number" class="form-control" placeholder="Harga Paket" name="price" value="{{old('price')}}">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" rows="8" cols="80" class="form-control">{{old('description')}}</textarea>
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('js')
  <script src="{{asset('plugins/tinymce/jquery.tinymce.min.js')}}"></script>
  <script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
  <script type="text/javascript">
  tinymce.init({
    selector: 'textarea',
    height: 300,
    menubar: false,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table contextmenu paste code'
      ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent '
  });
  </script>
@endsection
