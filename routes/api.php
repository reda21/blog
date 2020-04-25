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

Route::middleware('auth:api')->post("profile", ["uses" => 'Api\UserController@profileUpdate']);

Route::middleware('auth:api')->post("account", ["uses" => 'Api\UserController@accountUpdate']);

Route::middleware('auth:api')->post('avatar', ['uses' => 'Api\UserController@changeAvatar']);

Route::middleware('auth:api')->post('cover', ['uses' => 'Api\UserController@changeCover']);


Route::group(['prefix' => 'user', 'as' => 'user'], function () {
    Route::get("/", ["as" => ".index", "uses" => 'Api\UserController@index']);
    Route::get("/{id}", ["as" => ".sho", "uses" => 'Api\UserController@show']);
    Route::post('/{id}/{action}', ['as' => '.follow', 'uses' => 'Api\UserController@follow'])
        ->where('action', 'follow|unfollow')->middleware(['auth:api']);
});

//notification
Route::get('notifications', ['as' => 'user.notifications', 'uses' => 'Api\NotificationsController@GetNotifications'])->middleware(['auth:api']);
Route::delete('notifications/{id}', ['as' => 'user.notifications.delete', 'uses' => 'Api\NotificationsController@DeleteNotification'])->middleware(['auth:api']);
Route::delete('notifications', ['as' => 'user.notifications.deleteAll', 'uses' => 'Api\NotificationsController@DeleteAllNotification'])->middleware(['auth:api']);

