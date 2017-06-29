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
        <li class="active">Tukar Kamar</li>
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
              <h3 class="box-title">Tukar Kamar</h3>
            </div>

            <div class="box-body">
              <form role="form" action="{{Help::url('members/'.$id.'/switch')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <div class="box-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="email" class="form-control" placeholder="Email Member" value="{{$rental->User->name}}" disabled>
                  </div>
                  <div class="form-group">
                    <label>Rumah</label>
                    <select class="select2" style="width: 100%;" onchange="getRoom();" id="selectHouse">
                      <option>Pilih Rumah</option>
                      @foreach ($userpackage->House as $h)
                        <option value="{{$h->id}}">{{$h->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tukar Dengan Kamar</label>
                    <select class="select2" name="rental" id="room" style="width: 100%;">
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

    function getRoom() {
      $('#room').text('');
      var house_id = $("#selectHouse").find(':selected').val();
      var text = '<option>Pilih Kamar</option>';
      $.ajax({
        url: '{{Help::url('members')}}/'+house_id+'/getlistswitch',
        type: 'GET',
        success: function(res){
          $.each(res, function(index, el) {
            text += '<option value="'+el.id+'">Kamar Nomor : '+el.number+' - '+el.name+'</option>'
          });
          $('#room').append(text);
          $('#room').select2().trigger('change');
        }
      });

    }
  </script>
@endsection
