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
        <li class="active">Edit - {{$data->name}}</li>
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
              <h3 class="box-title">Edit Rumah</h3>
            </div>

            <div class="box-body">
              <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xl-offset-12">
                  <form role="form" action="{{Help::url('house-room')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="put">
                    {{ csrf_field() }}
                    <div class="box-body">
                      <div class="form-group">
                        <label>Nama Rumah</label>
                        <input type="text" class="form-control" placeholder="Nama Rumah" name="name" value="{{$data->name}}" required>
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat Rumah" name="address" value="{{$data->address}}" required>
                      </div>
                      <div class="form-group">
                        <label>Add Picture</label>
                        <input type="file" name="picture[]" class="form-control" accept="image/*" multiple="true" required>
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-offset-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Foto Rumah</h3>
            </div>
            <div class="box-body">
              <div class="row">
                @foreach ($data->Housepicture as $p)
                  <div class="col-md-4">
                    <a href="{{Help::js()}}" class="thumbnail" onclick="removePicture('{{$p->id}}')">
                      <img src="{{Help::img($p->url)}}" alt="">
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('js')
  
  <script type="text/javascript">

  </script>
@endsection
