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

// TABLE COMMON CODE
// Get Type Video List
Route::get('gettypevideolist','CommonCodeController@getTypeVideoList');
// Get Level List
Route::get('getlevellist','CommonCodeController@getLevelList');

// TABLE VIDEO TUTORIAL
// Get Video Tutorial List By Type
Route::get('getvideolistbytype','VideoTutorialController@getVideoListByType');
// Get Video Tutorial List By Type & Level
Route::get('getvideolistbytypelevel','VideoTutorialController@getVideoListByTypeLevel');
// Get Video Detail
Route::get('getvideodetail','VideoTutorialController@getVideoDetail');
