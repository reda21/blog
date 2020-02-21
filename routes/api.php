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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('alpha', function (Request $request){
    dd( $request->header('X-CSRF-TOKEN'), csrf_token());
});

Route::group(['prefix' => 'user', 'as' => 'user'], function () {
    Route::post('/{id}/{action}', ['as' => '.follow', 'uses' => 'Api\UserController@follow'])
        ->where('action', 'follow|unfollow')->middleware(['auth:api']);
});
