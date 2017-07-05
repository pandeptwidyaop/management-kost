@extends('layouts.master')
@section('css')

@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Report
        <small>Semua laporan fasilitas dan permasalahan pada kamar kost.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li><a href="{{Help::url('reports')}}">Report</a></li>
        <li class="active">{{$data->id}}</li>
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
              <h3 class="box-title">Semua laporan</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Laporan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{date('d F Y', strtotime($data->created_at))}}</td>
                    <td>{!!$data->message!!}</td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                @foreach ($data->Reportpicture as $p)
                  <div class="col-md-4">
                    <a href="{{Help::js()}}" class="thumbnail" onclick="showImage('{{Help::img($p->url)}}')">
                      <img src="{{Help::img($p->url)}}" alt="{{$p->id}}">
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

@endsection
