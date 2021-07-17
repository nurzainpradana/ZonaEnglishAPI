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
// Get Title List
Route::get('gettitlelist','CommonCodeController@getTitleList');

// TABLE VIDEO TUTORIAL
// Get Video Tutorial List By Type
Route::get('getvideolistbytype','VideoTutorialController@getVideoListByType');
// Get Video Tutorial List By Type & Level
Route::get('getvideolistbytypelevel','VideoTutorialController@getVideoListByTypeLevel');
// Get Video Detail
Route::get('getvideodetail','VideoTutorialController@getVideoDetail');
// TABLE INFO PROMO
// Get Info Promo List
Route::get('getinfopromolist','InfoPromoController@getInfoPromoList');
// Get Info Promo Top List
Route::get('getinfopromotoplist','InfoPromoController@getInfoPromoTopList');
// Get Info Promo Detail
Route::get('getinfopromodetail','InfoPromoController@getInfoPromoDetail');

// TABLE ONLINE MEETUP
Route::get('getonlinemeetup','OnlineMeetupController@getOnlineMeetup');
Route::get('getlistonlinemeetup','OnlineMeetupController@getListTutorVideo');
Route::get('getdetailonlinemeetupbytype','OnlineMeetupController@getOnlineMeetupByType');

//TABLE TUTOR
Route::get('gettutorlist', 'TutorController@getTutorList');
Route::get('getcategorytutor', 'TutorController@getCategoryTutor');
Route::get('gettutorbycategory', 'TutorController@getTutorByCategory');
Route::get('gettutorbycountry', 'TutorController@getTutorByCountry');
Route::get('getscheduletutor', 'TutorController@getScheduleTutor');

//TABLE SCHEDULE
Route::get('getlistschedule', 'ScheduleController@getListSchedule');

//LIVE CLASS
Route::get('getliveclassbytype', 'LiveClassController@getLiveClassByType');

// AUTH USER
Route::group(['prefix' => 'auth'], function () {
    Route::POST('/register-without-phone', 'Auth\UserController@registerWithOutNoPhone');
    Route::post('/register', 'Auth\UserController@register');
    Route::post('/login', 'Auth\UserController@login');
    Route::post('/login-email', 'Auth\UserController@loginEmail');
    Route::post('/logout', 'Auth\UserController@logout')
        ->middleware('auth:sanctum');
});

//Update Data User
Route::post('update-user', 'Auth\UserController@updateUser');
Route::post('update-no_phone', 'Auth\UserController@updateNoPhone');
