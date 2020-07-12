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

Route::get('/', function () {
    return view('auth/login');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/daftar', 'UserController@store')->name('daftar-admin');
Route::get('logout', 'Auth\LoginController@logout');

Route::get('master/dashboard', function () {
    return view('master/dashboard');
});
Route::get('merchant/dashboard', function () {
    return view('merchant/dashboard');
});

// master
Route::get('master/room/category', 'RoomCategoryController@index')->middleware('role:0');
Route::post('master/room/category', 'RoomCategoryController@store')->name('create.room_category')->middleware('role:0');
Route::get('master/room/category/{id}', 'RoomCategoryController@destroy')->name('del.room_category')->middleware('role:0');
Route::post('master/room/category/{id}', 'RoomCategoryController@update')->name('up.room_category')->middleware('role:0');

Route::get('master/room/setup', 'SetupController@index')->middleware('role:0');
Route::post('master/room/setup', 'SetupController@store')->name('create.room_setup')->middleware('role:0');
Route::get('master/room/setup/{id}', 'SetupController@destroy')->name('del.room_setup')->middleware('role:0');
Route::post('master/room/setup/{id}', 'SetupController@update')->name('up.room_setup')->middleware('role:0');

Route::get('master/facility/category', 'FacilityCategoryController@index')->middleware('role:0');
Route::post('master/facility/category', 'FacilityCategoryController@store')->name('create.facility_category')->middleware('role:0');
Route::get('master/facility/category/{id}', 'FacilityCategoryController@destroy')->name('del.facility_category')->middleware('role:0');
Route::post('master/facility/category/{id}', 'FacilityCategoryController@update')->name('up.facility_category')->middleware('role:0');

Route::get('master/building/type', 'BuildingTypeController@index')->middleware('role:0');
Route::post('master/building/type', 'BuildingTypeController@store')->name('create.building_type')->middleware('role:0');
Route::get('master/building/type/{id}', 'BuildingTypeController@destroy')->name('del.building_type')->middleware('role:0');
Route::post('master/building/type/{id}', 'BuildingTypeController@update')->name('up.building_type')->middleware('role:0');

Route::get('master/data/user', 'UserController@index')->middleware('role:0');
Route::get('master/data/user/{id}', 'UserController@destroy')->name('del.user')->middleware('role:0');
Route::post('master/data/user/{id}', 'UserController@update')->name('up.user')->middleware('role:0');

Route::get('master/package', 'PackageController@index')->middleware('role:0');
Route::post('master/package', 'PackageController@store')->name('create.package')->middleware('role:0');
Route::get('master/package/{id}', 'PackageController@destroy')->name('del.package')->middleware('role:0');
Route::post('master/package/{id}', 'PackageController@update')->name('up.package')->middleware('role:0');

Route::get('master/form', 'FormController@index')->middleware('role:0');
Route::post('master/form', 'FormController@store')->name('create.form')->middleware('role:0');
Route::get('master/form/{id}', 'FormController@destroy')->name('del.form')->middleware('role:0');
Route::post('master/form/{id}', 'FormController@update')->name('up.form')->middleware('role:0');

Route::get('master/data/promo', 'PromoController@index')->name('index.promo.master')->middleware('role:0');
Route::post('master/data/promo', 'PromoController@store')->name('create.promo.master')->middleware('role:0');
Route::get('master/data/promo/{id}', 'PromoController@destroy')->name('del.promo.master')->middleware('role:0');
Route::post('master/data/promo/{id}', 'PromoController@update')->name('up.promo.master')->middleware('role:0');

// merchant
Route::get('merchant/room', 'RoomController@index')->name('index.room.merchant')->middleware('role:1');
Route::get('merchant/room/create', 'RoomController@create')->name('add.room')->middleware('role:1');
Route::post('merchant/room', 'RoomController@store')->name('create.room')->middleware('role:1');
Route::get('merchant/room/{id}', 'RoomController@destroy')->name('del.room')->middleware('role:1');
Route::get('merchant/room/edit/{id}', 'RoomController@edit')->name('edit.room')->middleware('role:1');
Route::post('merchant/room/{id}', 'RoomController@update')->name('up.room')->middleware('role:1');

Route::get('merchant/building', 'BuildingController@index')->name('index.building')->middleware('role:1');
Route::get('merchant/building/create', 'BuildingController@create')->name('add.building')->middleware('role:1');
Route::post('merchant/building', 'BuildingController@store')->name('create.building')->middleware('role:1');
Route::get('merchant/building/{id}', 'BuildingController@destroy')->name('del.building')->middleware('role:1');
Route::get('merchant/building/edit/{id}', 'BuildingController@edit')->name('edit.building')->middleware('role:1');
Route::post('merchant/building/{id}', 'BuildingController@update')->name('up.building')->middleware('role:1');

Route::get('merchant/promo', 'PromoController@index')->name('index.promo.merchant')->middleware('role:1');
Route::post('merchant/promo', 'PromoController@store')->name('create.promo.merchant')->middleware('role:1');
Route::get('merchant/promo/{id}', 'PromoController@destroy')->name('del.promo.merchant')->middleware('role:1');
Route::post('merchant/promo/{id}', 'PromoController@update')->name('up.promo.merchant')->middleware('role:1');


Route::get('merchant/orders', 'OrderController@index')->name('index.order.merchant');
Route::get('merchant/order/{id}', 'OrderController@show')->name('pre.order.merchant');
Route::post('merchant/edit/order/{id}', 'OrderController@update')->name('up.order.merchant');
Route::get('merchant/delete/order/{id}', 'OrderController@destroy')->name('del.order.merchant');

// schedule
Route::get('merchant/schedule', 'ScheduleController@index')->name('index.schedule')->middleware('role:1');
