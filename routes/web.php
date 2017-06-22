<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('images/{folder}/{file}', function($folder, $file){
  return \Storage::disk('public')->get($folder.'/'.$file);
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function(){
  return redirect('/redirecting');
});

Route::get('/redirecting', function(){
  if (Auth::user()->type == 'admin') {
      return redirect('admin');
  } elseif (Auth::user()->type == 'kost_owner') {
      return redirect('ibu-kost');
  } else {
      return redirect('anak-kost');
  }
});

//ADMIN

Route::group(['middleware' => 'role:admin','prefix' => 'admin', 'namespace' => 'Admin'], function(){
  Route::get('/', function(){
    return redirect('admin/dashboard');
  });
  Route::get('dashboard','DashboardController@index');
  Route::resource('packages','PackageController');
  Route::resource('users','UserController');
  Route::get('payments','PaymentController@index');
  Route::get('payments/create','PaymentController@create');
  Route::post('payments/create/{id}','PaymentController@createbilling');
  Route::post('payments/approve/{id}','PaymentController@approve');
  Route::get('profile','ProfileController@index');
  Route::post('profile','ProfileController@update');
  Route::post('profile/avatar','ProfileController@changeimage');
  Route::post('profile/password','ProfileController@changepassword');
});

Route::group(['middleware' => 'role:kost_owner','prefix' => 'ibu-kost','namespace' => 'KostOwner'], function(){
  Route::get('/', function(){
    return redirect('ibu-kost/dashboard');
  });
  Route::get('dashboard','DashboardController@index');
  Route::get('house-room','HouseRoomController@index');
  Route::post('house-room','HouseRoomController@store');
  Route::get('house-room/create-house','HouseRoomController@create');
  Route::get('house-room/{id}/manage','HouseRoomController@manage');
  Route::get('house-room/{id}/edit','HouseRoomController@edit');
  Route::get('house-room/{id}/manage/create-room','HouseRoomController@createRoom');
});

Route::group(['middleware' => 'role:tenant','prefix' => 'anak-kost','namespace' => 'Tenant'], function(){
  Route::get('/', function(){
    return redirect('ibu-kost/dashboard');
  });
  Route::get('dashboard','DashboardController@index');
});
