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

Route::post('store' ,'AddressController@store');
Route::get('delete/{id}' ,'AddressController@destroy');
Route::get('list' ,'AddressController@index');
Route::get('show/{id}' ,'AddressController@show');
Route::get('edit/{id}' ,'AddressController@edit');
Route::post('update/{id}' ,'AddressController@update');
Route::get('zip-code' , function () {
    return view('cep');
});
