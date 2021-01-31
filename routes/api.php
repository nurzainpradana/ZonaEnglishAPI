<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('commoncode','CommonCodeController@index');
Route::post('commoncode','CommonCodeController@create');
Route::put('/commoncode/{hcode}','CommonCodeController@update');
Route::delete('/commoncode/{hcode}','CommonCodeController@delete');

// Get Video Belajar List
Route::get('gettypevideo','CommonCodeController@getTypeVideo');

// Get Level List
Route::get('getlevel','CommonCodeController@getLevel');