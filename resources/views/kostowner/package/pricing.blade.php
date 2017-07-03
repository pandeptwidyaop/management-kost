@extends('layouts.master')
@section('css')

@endsection
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Packages
        <small>Sesuaikan paket berdasarkan kebutuhan anda.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{Help::url()}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{Help::url()}}">Dashboard</a></li>
        <li><a href="{{Help::url()}}">Package</a></li>
        <li class="active">Pricing</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Pricing</h4>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="{{Help::url('packages/pricing?a='.$act.'&p='.$paket)}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label>Paket</label>
                      <input type="text" class="form-control" value="{{$package->name}}" disabled>
                    </div>
                    <div class="form-group">
                      <label>Pembayaran</label>
                      <select name="payment" class="form-control" id="payment" id="payment" onchange="calculate(this.value)">
                        <option>Pilih</option>
                        <option value="3">3 Bulan</option>
                        <option value="6">6 Bulan</option>
                        <option value="12">12 Bulan</option>
                        <option value="24">24 Bulan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Total Bayar</label>
                      <input type="text" value="" class="form-control bayar">
                    </div>
                    <div class="form-group">
                      <label>Periode Berlaku</label>
                      <input type="text" value="" class="form-control" id="periode">
                    </div>
                    <button type="submit" class="btn btn-flat btn-primary pull-right">Lanjutkan</button>
                  </form>
                </div>
                <div class="col-md-6">
                  <blockquote>
                    <p>Paket anda akan aktif setelah melakukan pembayaran. Pastikan anda melakukan pembayaran sebelum besok.</p>
                  </blockquote>
                  <h1 id="bayar"></h1>
                </div>
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
  var price = '{{$package->price}}';
  function calculate(num){
    var count = price * num;
    $.getJSON('{{url('api')}}/getpackageperiode', {month: num}, function(json, textStatus) {
      $('.bayar').val('Rp. '+addCommas(count));
      $('#periode').val(json);
      $('#bayar').text('Rp. '+addCommas(count)+ ' - '+json);
    });

  }

  function addCommas(nStr){
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
</script>
@endsection
