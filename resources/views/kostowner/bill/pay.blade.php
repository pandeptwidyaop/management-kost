<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="total" content="{{$total}}">
    <title>Pembayaran Tahgihan : {{$pay->id}}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
      <div id="app">
        <bank :banks="banks" :total="total"></bank>
      </div>
    </div>
  <script src="{{asset('js/app.js')}}" charset="utf-8"></script>
  </body>
</html>
