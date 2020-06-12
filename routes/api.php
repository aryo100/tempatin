<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('kota/{id}', 'BuildingController@api_kota');
Route::get('form/detail/{id}', 'FormController@api_form_detail');
Route::get('package/detail/{id}', 'RoomController@api_package_detail');

