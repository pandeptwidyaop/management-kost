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
  } elseif (Auth::user()->type == 'tenant') {
      return redirect('anak-kost');
  }
});

Route::get('/registration','RegistrationController@index');
Route::post('/registration','RegistrationController@register');

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
  Route::put('house-room/{id}','HouseRoomController@update');
  Route::post('house-room/{id}/room','HouseRoomController@storeRoom');
  Route::get('house-room/{id}/room-edit','HouseRoomController@editRoom');
  Route::put('house-room/{id}/room-edit','HouseRoomController@updateRoom');
  Route::get('house-room/{id}/manage/create-room','HouseRoomController@createRoom');
  Route::delete('house-room/{id}/remove-picture','HouseRoomController@removePicture');
  Route::delete('house-room/{id}/room','HouseRoomController@destroyRoom');
  Route::delete('house-room/{id}/house','HouseRoomController@destroyHouse');

  Route::get('members', 'MembersController@index');
  Route::get('members/create','MembersController@create');
  Route::get('members/create/{id}/room','MembersController@listroom');
  Route::get('members/{id}/getlistswitch','MembersController@getlistswitch');
  Route::post('members/create','MembersController@store');
  Route::get('members/{id}/change','MembersController@changeRoomMember');
  Route::put('members/{id}/change','MembersController@change');
  Route::get('members/{id}/switch','MembersController@switchRoomMember');
  Route::put('members/{id}/switch','MembersController@switch');
  Route::delete('members/{id}/remove','MembersController@remove');

  Route::get('payments', 'PaymentController@index');
  Route::post('payments/approve/{id}','PaymentController@approve');
  Route::get('payments/create','PaymentController@create');
  Route::post('payments/create','PaymentController@store');
  Route::delete('payments/{id}','PaymentController@destroy');

  Route::get('reports','ReportController@index');
  Route::get('reports/{id}', 'ReportController@show');

  Route::get('bank','BankController@index');
  Route::get('bank/{id}/edit','BankController@edit');
  Route::post('bank','BankController@store');
  Route::put('bank/{id}','BankController@update');
  Route::delete('bank/{id}','BankController@destroy');

  Route::get('packages', 'PackageController@index');
  Route::get('packages/{id}/select', 'PackageController@select');
  Route::get('packages/{id}/upgrade', 'PackageController@upgrade');
  Route::get('packages/{id}/downgrade','PackageController@downgrade');
  Route::get('packages/pricing','PackageController@pricing');
  Route::post('packages/pricing','PackageController@newpackage');
  Route::get('packages/changeplan','PackageController@changeplan');
  Route::post('packages/changeplan','PackageController@changebill');

  Route::get('bills', 'BillController@index');
  Route::get('bills/{id}', 'BillController@show');
  Route::get('bills/{id}/payment','BillController@payment');
  Route::post('bills/{id}/confirm', 'BillController@confirm');
  Route::get('banks','BillController@getListOfBank');

  Route::get('profile','ProfileController@index');
  Route::post('profile','ProfileController@update');
  Route::post('profile/avatar','ProfileController@changeimage');
  Route::post('profile/password','ProfileController@changepassword');
});

Route::group(['middleware' => 'role:tenant','prefix' => 'anak-kost','namespace' => 'Tenant'], function(){
  Route::get('/', function(){
    return redirect('anak-kost/dashboard');
  });
  Route::get('dashboard','DashboardController@index');
  Route::get('billings','BillingController@index');
  Route::post('billings/{id}','BillingController@confirm');
  Route::get('reports','ReportController@index');
  Route::post('reports','ReportController@store');
  Route::get('profile','ProfileController@index');
  Route::post('profile','ProfileController@update');
  Route::post('profile/avatar','ProfileController@changeimage');
  Route::post('profile/password','ProfileController@changepassword');
});
