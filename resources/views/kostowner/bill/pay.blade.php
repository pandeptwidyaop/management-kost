<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{Help::url('banks')}}">
    <meta name="total" content="'{{$total}}'">
    <title>Pembayaran Tahgihan : {{$pay->id}}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">Pembayaran Tagihan</div>
                  <div class="panel-body">
                    <div class="text-center">
                      <p>  Silakan transfer tepat <h1> Rp. {{$total}}</h1> ke salah satu rekening di bawah ini, pastikan anda menyimpan bukti pembayarannya dan sertakan pada saat konformasi pembayaran.</p>
                    </div>
                    <div class="row">
                      @foreach ($bank as $list)
                        <div class="col-md-4">
                          <div class="thumbnail">
                            <div class="caption text-center">
                              <h3 align="center">Bank {{$list['bank']}}</h3>
                              <h5>Nomor Rekening : {{$list['number']}}</h5>
                              <small> AN : {{$list['name']}}</small>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </body>
</html>
