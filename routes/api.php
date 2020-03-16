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

Route::middleware('auth:api')->get('/me', 'Api\UserController@me');

Route::middleware('auth:api')->post("profile", ["as" => "user.profile", "uses" => 'Api\UserController@profileUpdate']);

Route::middleware('auth:api')->post("account", ["as" => "user.profile", "uses" => 'Api\UserController@accountUpdate']);

Route::middleware('auth:api')->post('avatar', ['as' => '.changeAvatar', 'uses' => 'Api\UserController@changeAvatar']);


Route::group(['prefix' => 'user', 'as' => 'user'], function () {
    Route::get("/", ["as" => ".index", "uses" => 'Api\UserController@index']);
    Route::get("/{id}", ["as" => ".sho", "uses" => 'Api\UserController@show']);
    Route::post('/{id}/{action}', ['as' => '.follow', 'uses' => 'Api\UserController@follow'])
        ->where('action', 'follow|unfollow')->middleware(['auth:api']);
});
