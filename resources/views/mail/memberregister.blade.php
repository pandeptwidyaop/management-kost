@component('mail::message')
  <b>Untuk Melengkapi Registrasi Silakan Klik Button Dibawah</b>
  @component('mail::button',['url' => $data])
    Registrasi
  @endcomponent

  Terimakasih,
  {{config('app.name')}}
@endcomponent
