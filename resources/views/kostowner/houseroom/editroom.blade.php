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
              <h3 class="box-title">Edit Kamar</h3>
            </div>

            <div class="box-body">
              <form role="form" action="{{Help::url('house-room/'.$data->id.'/room-edit')}}" method="post" id="formCreate">
                <input type="hidden" name="_method" value="put">
                {{ csrf_field() }}
                <div class="box-body">
                  <div class="form-group">
                    <label>Nomor Kamar</label>
                    <input type="text" class="form-control" placeholder="Nomor Kamar" name="number" value="{{$data->number}}" required>
                  </div>
                  <div class="form-group">
                    <label>Harga Sewa Perbulan</label>
                    <input type="number" class="form-control" placeholder="Harga Sewa" name="price" value="{{$data->price}}" required>
                  </div>
                  <div class="form-group">
                    <label>Fasilitas</label>
                    <textarea name="facility" rows="8" cols="80" required>{{$data->facility}}</textarea>
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
