<?php

use App\Http\Controllers\Auth\UserController as AuthUserController;
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


/**
 * User Register, Login, Logout
 */
Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', 'Auth\UserController@register');
    Route::post('/login', 'Auth\UserController@login');
    Route::post('/loginEmail', 'Auth\UserController@loginEmail');
    Route::post('/logout', 'Auth\UserController@logout')
        ->middleware('auth:sanctum');
});
