<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','CommonCodeController@index')->name('commoncode');

// DATA MASTER COMMON CODE
Route::get('/commoncode','CommonCodeController@index')->name('commoncode');
Route::get('/createcommoncode','CommonCodeController@create')->name('commoncode.create');
Route::get('/updatecommoncode/{hcode}/{code}', 'CommonCodeController@update')->name('commoncode.update');
Route::post('/saveupdatecommoncode','CommonCodeController@saveUpdate')->name('commoncode.saveupdate');
Route::get('/deletecommoncode/{hcode}/{code}','CommonCodeController@delete')->name('commoncode.delete');
Route::post('/savecommoncode','CommonCodeController@saveCreate')->name('commoncode.save');

// DATA MASTER VIDEO TUTORIAL
Route::get('/videotutorial','VideoTutorialController@index')->name('videotutorial');
Route::get('/createvideotutorial','VideoTutorialController@create')->name('videotutorial.create');
Route::get('/updatevideotutorial/{code}', 'VideoTutorialController@update')->name('videotutorial.update');
Route::post('/saveupdatevideotutorial','VideoTutorialController@saveUpdate')->name('videotutorial.saveupdate');
Route::get('/deletevideotutorial/{code}','VideoTutorialController@delete')->name('videotutorial.delete');
Route::post('/savevideotutorial','VideoTutorialController@saveCreate')->name('videotutorial.save');

// DATA MASTER INFO PROMO
Route::get('/infopromo','InfoPromoController@index')->name('infopromo');
Route::get('/createinfopromo','InfoPromoController@create')->name('infopromo.create');
Route::get('/updateinfopromo/{code}', 'InfoPromoController@update')->name('infopromo.update');
Route::post('/saveupdateinfopromo','InfoPromoController@saveUpdate')->name('infopromo.saveupdate');
Route::get('/deleteinfopromo/{code}','InfoPromoController@delete')->name('infopromo.delete');
Route::post('/saveinfopromo','InfoPromoController@saveCreate')->name('infopromo.save');

// DATA MASTER USERS
Route::get('/users','UsersController@index')->name('users');
Route::get('/createusers','UsersController@create')->name('users.create');
Route::get('/updateusers/{code}', 'UsersController@update')->name('users.update');
Route::post('/saveupdateusers','UsersController@saveUpdate')->name('users.saveupdate');
Route::get('/deleteusers/{code}','UsersController@delete')->name('users.delete');
Route::post('/saveusers','UsersController@saveCreate')->name('users.save');

// DATA MASTER TUTOR
Route::get('/tutor','TutorController@index')->name('tutor');
Route::get('/createtutor','TutorController@create')->name('tutor.create');
Route::get('/updatetutor/{code}', 'TutorController@update')->name('tutor.update');
Route::post('/saveupdatetutor','TutorController@saveUpdate')->name('tutor.saveupdate');
Route::get('/deletetutor/{code}','TutorController@delete')->name('tutor.delete');
Route::post('/savetutor','TutorController@saveCreate')->name('tutor.save');

Route::get('/gettypelist','VideoTutorialController@getTypeList')->name('videotutorial.gettypelist');
Route::get('/getlevellist','VideoTutorialController@getLevelList')->name('videotutorial.getlevellist');

Route::get('/gettitlelist','TutorController@getTitleList')->name('tutor.gettitlelist');
Route::get('/getexperiencelist','TutorController@getExperienceList')->name('tutor.getexperiencelist');
Route::get('/getcountrylist','TutorController@getCountryList')->name('tutor.getcountrylist');