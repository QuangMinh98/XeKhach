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

Route::get('noidi','apiController@getNoiDi');
Route::get('chuyendi','apiController@getChuyenDi');
Route::get('chitiet/{id}','apiController@chiTietChuyenXe');
Route::get('thongtin','apiController@getInfo');
Route::post('login','apiController@Login');
Route::post('getuser','apiController@getuser');
Route::post('register','apiController@register');
Route::get('getTicket','apiController@getTicket');
Route::get('getSuccess','apiController@getSuccess');
Route::get('getCancel','apiController@getCancel');
Route::get('ticketById/{id}','apiController@getTicketById');
Route::post('checkout','apiController@checkOut');
Route::post('datve','apiController@booking');
Route::post('huyve','apiController@huyve');
Route::get('viewThongTin','apiController@viewThongTin');