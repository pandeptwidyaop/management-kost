@php
  $URL = 'admin/';
  $TYPE = 'Admin';
  if (Auth::user()->type == 'kost_owner') {
    $URL = 'ibu-kost/';
    $TYPE = 'Ibu Kost';
  }elseif (Auth::user()->type == 'tenant') {
    $URL = 'anak-kost';
    $TYPE = 'Anak Kost';
  }
@endphp
