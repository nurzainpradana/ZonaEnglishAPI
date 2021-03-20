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