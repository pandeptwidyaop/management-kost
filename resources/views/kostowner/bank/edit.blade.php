@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
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
        <li><a href="{{Help::url('members')}}">Bank</a></li>
        <li class="active">Edit ({{$data->provider}})</li>
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
              <h3 class="box-title">Edit Bank : {{$data->provider}}</h3>
            </div>

            <div class="box-body">
              <form role="form" action="{{Help::url('bank/'.$data->id)}}" method="post">
                <input type="hidden" name="_method" value="put">
                {{ csrf_field() }}
                <div class="box-body">
                  <div class="form-group">
                    <label for="">Bank</label>
                    <input type="text" class="form-control" id="" placeholder="Bank" name="provider" value="{{$data->provider}}">
                  </div>
                  <div class="form-group">
                    <label for="">Nomor Rekening</label>
                    <input type="text" class="form-control" id="" placeholder="Nomor Rekening" name="number" value="{{$data->number}}">
                  </div>
                  <div class="form-group">
                    <label for="">Nama Di Rekening</label>
                    <input type="text" class="form-control" id="" placeholder="Nama" name="name" value="{{$data->name}}">
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
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    $(function(){
      $(".select2").select2();
    });

    function getHouse(){
      var id = $('#selectHouse').find(':selected').val();
      $('#room').text('');
      $.ajax({
        url: '{{Help::url('members/create')}}/'+id+'/room',
        type: 'GET',
        success: function(data){
          var option = 'option>Pilih Kamar</option>';
          $.each(data,function(index, el) {
            option += '<option value="'+el.id+'"> Kamar Nomor : '+el.number+'</option>';
          });
          $('#room').append(option);
          $('#room').select2().trigger('change');
        }
      });

    }
  </script>
@endsection
