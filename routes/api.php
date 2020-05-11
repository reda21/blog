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


Route::group(['prefix' => 'user'], function () {
    Route::get("/", ["uses" => 'Api\UserController@index']);
    Route::get("/{id}", ["uses" => 'Api\UserController@show']);
    Route::post('/{id}/{action}', ['uses' => 'Api\FriendController@follow'])
        ->where('action', 'follow|unfollow')->middleware(['auth:api']);
    Route::get('/{id}/following', ['uses' => 'Api\FriendController@getfollowing'])->middleware(['auth:api']);
    Route::get('/{id}/followers', ['uses' => 'Api\FriendController@getfollowers'])->middleware(['auth:api']);
    Route::post('/{id}/request', ['uses' => 'Api\FriendController@request'])->middleware(['auth:api']);
});

//notification
Route::get('notifications', ['uses' => 'Api\NotificationsController@GetNotifications'])->middleware(['auth:api']);
Route::delete('notifications/{id}', ['uses' => 'Api\NotificationsController@DeleteNotification'])->middleware(['auth:api']);
Route::delete('notifications', ['uses' => 'Api\NotificationsController@DeleteAllNotification'])->middleware(['auth:api']);

//chat
Route::resource('chat', 'Api\ChatController', ['except' => ['create', 'edit', 'update']])->middleware(['auth:api']);
Route::post('chat/{id}', ['uses' => 'Api\ChatController@Send'])->middleware(['auth:api']);
