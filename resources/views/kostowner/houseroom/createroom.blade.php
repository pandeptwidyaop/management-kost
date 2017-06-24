@extends('layouts.master')
@section('css')

@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        House & Room
        <small>Manage semua rumah beserta kamar.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li><a href="{{Help::url('house-room')}}">House & Room</a></li>
        <li class="active">Create Room ({{$data->name}})</li>
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
              <h3 class="box-title">Tambah Kamar</h3>
            </div>

            <div class="box-body">
              <form role="form" action="{{Help::url('house-room/'.$data->id.'/room')}}" method="post" id="formCreate">
                {{ csrf_field() }}
                <div class="box-body">
                  <div class="form-group">
                    <label>Nomor Kamar</label>
                    <input type="text" class="form-control" placeholder="Nomor Kamar" name="number" value="{{old('number')}}" required>
                  </div>
                  <div class="form-group">
                    <label>Harga Sewa Perbulan</label>
                    <input type="number" class="form-control" placeholder="Harga Sewa" name="price" value="{{old('price')}}" required>
                  </div>
                  <div class="form-group">
                    <label>Fasilitas</label>
                    <textarea name="facility" rows="8" cols="80" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>Gandakan</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <input type="checkbox" name="duplicate" id="duplicate">
                      </span>
                      <input class="form-control" name="copy" type="number" placeholder="Sisa pembuatan kamar adalah {{$remains}}" id="copy">
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <button type="button" class="btn btn-primary btn-flat" onclick="submitRoom()">Submit</button>
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
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
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

  function submitRoom(){
    var limit = {{$remains}};
    var copy = $('#copy').val();
    var duplicate = $('#duplicate').val()
    if (duplicate == 'on' && copy > limit) {
      bootbox.alert("Anda tidak dapat membuat kamar lebih dari "+limit);
    }else {
      $('#formCreate').submit();
    }
  }
  </script>
@endsection
