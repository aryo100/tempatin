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
Route::get('master/room/category', 'RoomCategoryController@index');
Route::post('master/room/category', 'RoomCategoryController@store')->name('create.room_category');
Route::get('master/room/category/{id}', 'RoomCategoryController@destroy')->name('del.room_category');
Route::post('master/room/category/{id}', 'RoomCategoryController@update')->name('up.room_category');

Route::get('master/room/setup', 'SetupController@index');
Route::post('master/room/setup', 'SetupController@store')->name('create.room_setup');
Route::get('master/room/setup/{id}', 'SetupController@destroy')->name('del.room_setup');
Route::post('master/room/setup/{id}', 'SetupController@update')->name('up.room_setup');

Route::get('master/facility/category', 'FacilityCategoryController@index');
Route::post('master/facility/category', 'FacilityCategoryController@store')->name('create.facility_category');
Route::get('master/facility/category/{id}', 'FacilityCategoryController@destroy')->name('del.facility_category');
Route::post('master/facility/category/{id}', 'FacilityCategoryController@update')->name('up.facility_category');

Route::get('master/building/type', 'BuildingTypeController@index');
Route::post('master/building/type', 'BuildingTypeController@store')->name('create.building_type');
Route::get('master/building/type/{id}', 'BuildingTypeController@destroy')->name('del.building_type');
Route::post('master/building/type/{id}', 'BuildingTypeController@update')->name('up.building_type');

Route::get('master/data/user', 'UserController@index');
Route::get('master/data/user/{id}', 'UserController@destroy')->name('del.user');
Route::post('master/data/user/{id}', 'UserController@update')->name('up.user');

Route::get('master/package', 'PackageController@index');
Route::post('master/package', 'PackageController@store')->name('create.package');
Route::get('master/package/{id}', 'PackageController@destroy')->name('del.package');
Route::post('master/package/{id}', 'PackageController@update')->name('up.package');

Route::get('master/form', 'FormController@index');
Route::post('master/form', 'FormController@store')->name('create.form');
Route::get('master/form/{id}', 'FormController@destroy')->name('del.form');
Route::post('master/form/{id}', 'FormController@update')->name('up.form');

// merchant
Route::get('merchant/room', 'RoomController@index')->name('index.room');
Route::get('merchant/room/create', 'RoomController@create')->name('add.room');
Route::post('merchant/room', 'RoomController@store')->name('create.room');
Route::get('merchant/room/{id}', 'RoomController@destroy')->name('del.room');
Route::get('merchant/room/edit/{id}', 'RoomController@edit')->name('edit.room');
Route::post('merchant/room/{id}', 'RoomController@update')->name('up.room');

Route::get('merchant/building', 'BuildingController@index')->name('index.building');
Route::get('merchant/building/create', 'BuildingController@create')->name('add.building');
Route::post('merchant/building', 'BuildingController@store')->name('create.building');
Route::get('merchant/building/{id}', 'BuildingController@destroy')->name('del.building');
Route::get('merchant/building/edit/{id}', 'BuildingController@edit')->name('edit.building');
Route::post('merchant/building/{id}', 'BuildingController@update')->name('up.building');

Route::get('merchant/promo', 'PromoController@index')->name('index.promo');
Route::post('merchant/promo', 'PromoController@store')->name('create.promo');
Route::get('merchant/promo/{id}', 'PromoController@destroy')->name('del.promo');
Route::post('merchant/promo/{id}', 'PromoController@update')->name('up.promo');

// schedule
Route::get('merchant/schedule', 'ScheduleController@index')->name('index.room');
