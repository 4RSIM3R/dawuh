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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('register', 'Api\AuthController@register');
});

Route::group(['prefix' => 'dawuh', 'middleware' => ['jwt.verify']], function () {
    Route::get('all', 'Api\DawuhController@index');
    Route::get('detail/{id}', 'Api\DawuhController@detail');
    Route::post('add', 'Api\DawuhController@add');
    Route::put('update/{id}', 'Api\DawuhController@update');
    Route::delete('delete/{id}', 'Api\DawuhController@delete');
});

Route::group(['prefix' => 'me', 'middleware' => ['jwt.verify']], function () {
    Route::get('/', 'Api\AuthController@register');
});

// Route::group(['prefix' => 'dawuh'], function () {
//     Route::get('all', 'Api\DawuhController@all');
//     Route::post('add', 'Api\DawuhController@add');
//     Route::get('{id}', 'Api\DawuhController@detail');
//     Route::put('update/{id}', 'Api\DawuhController@update');
//     Route::delete('delet/{id}', 'Api\DawuhController@delete');
// });
