@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Report
        <small>Data laporan anda</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li class="active">Report</li>
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
              <h3 class="box-title">Data Laporan</h3>
            </div>
            <div class="box-body">
              <button type="button" class="btn btn-flat btn-primary" onclick="$('#report').modal('show')">Buat Laporan</button>
              <hr>
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th>ID Laporan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Laporan</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $r)
                    @php
                      if ($r->read_status == 'read') {
                        $status = ['type' => 'info', 'msg' => 'On Process'];
                      }else {
                        $status = ['type' => 'warning', 'msg' => 'Pending'];
                      }
                    @endphp
                    <tr>
                      <td>{{$r->id}}</td>
                      <td>{{date('d F Y',strtotime($r->created_at))}}</td>
                      <td>{!!$r->message!!}</td>
                      <td><span class="label label-{{$status['type']}}">{{$status['msg']}}</span></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="">Laporkan Masalah Anda</h4>
        </div>
        <div class="modal-body">
          <form class="" action="{{Help::url('reports')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="">Laporan</label>
              <textarea name="message" rows="8" cols="80" class="form-control" id="txt"></textarea>
            </div>
            <div class="form-group">
              <label for="">Photo</label>
              <input type="file" class="form-control" name="picture[]" accept="image/*" multiple>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('plugins/tinymce/jquery.tinymce.min.js')}}"></script>
  <script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
  <script>
    $(function(){
      $('table').dataTable({
        order: [[1,"desc"]]
      });

      $('#report').on('show.bs.modal', function(){
        tinymce.init({
          selector: '#txt',
          height: 300,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
            ],
          toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent '
        });
      });
    })


  </script>
@endsection
