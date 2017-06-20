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
        <li class="active">Create</li>
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
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              @php
                $act = 0;
              @endphp
              @foreach ($data->Housepicture as $p)
                <li data-target="#carousel-example-generic" data-slide-to="{{$act}}" class="{{($act == 0) ? 'active' : ''}}"></li>
                @php
                  $act +=1;
                @endphp
              @endforeach
            </ol>
            <div class="carousel-inner">
              @php
                $act = 0;
              @endphp
              @foreach ($data->Housepicture as $p)
                <div class="item {{($act == 0) ? 'active' : ''}}">
                  <img src="{{Help::img($p->url)}}" alt="{{$p->House->name}}" style="width:100%">
                  <div class="carousel-caption">
                    {{$p->House->name}}
                  </div>
                </div>
                @php
                  $act += 1;
                @endphp
              @endforeach
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
              <span class="fa fa-angle-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
              <span class="fa fa-angle-right"></span>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

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
