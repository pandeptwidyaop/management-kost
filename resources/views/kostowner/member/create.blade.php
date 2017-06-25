@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Member
        <small>Manage semua member atau anak kost di rumah anda.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li><a href="{{Help::url('members')}}">Member</a></li>
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
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Member</h3>
            </div>

            <div class="box-body">
              <form role="form" action="{{Help::url('members/create')}}" method="post">
                {{ csrf_field() }}
                <div class="box-body">
                  <div class="form-group">
                    <label>Email Member</label>
                    <input type="email" class="form-control" placeholder="Email Member" name="email" value="{{old('name')}}" required>
                  </div>
                  <div class="form-group">
                    <label>Rumah</label>
                    <select class="select2" style="width: 100%;" onchange="getHouse();" id="selectHouse">
                      @foreach ($userpackage->House as $h)
                        <option>Pilih Rumah</option>
                        <option value="{{$h->id}}">{{$h->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Kamar</label>
                    <select class="select2" name="room" id="room" style="width: 100%;">
                      <option>Pilih Kamar</option>
                    </select>
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
