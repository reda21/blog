<?php

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

use App\Models\User;
use App\Services\Helper;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Spatie\Permission\Models\Role;

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/home', 'HomeController@index')->name('home');

// auth
Auth::routes(['verify' => true]);

// Socialite Register Routes
Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

//3 user
Route::group(['prefix' => 'user', 'as' => 'user'], function () {
    Route::get('{user?}', ['uses' => 'UserController@members']);
    Route::get('{user}/following', ['as' => '.members.user.following', 'uses' => 'UserController@following']);
    Route::get('{user}/followers', ['as' => '.members.user.followers', 'uses' => 'UserController@followers']);
    Route::get('{user}/tutoriels', ['as' => '.tutoriels', 'uses' => 'userController@myTutoList']);
    Route::get('{user}/friends', ['as' => '.friends', 'uses' => 'userController@myFriends']);
});

Route::get('user/email/reset/{id}/{email}/{token}', 'MailResetController@getChangeMailAddress');

Route::group(['prefix' => 'acount', 'as' => 'user'], function () {
    Route::get('/', ['as' => '.profile', 'uses' => 'UserController@profil']);
    Route::get('edit', ['as' => '.edit', 'uses' => 'UserController@profil_edit']);
    Route::post('edit', ['as' => '.profil_update', 'uses' => 'UserController@profil_update']);
    Route::post("showOnline", ["as" => ".showOnline", 'uses' => 'UserController@showOnline']);
    Route::get("notification", ["as" => ".editConfigNotification", 'uses' => 'UserController@editConfigNotification']);
    Route::post("notification", ["as" => ".updateConfigNotification", 'uses' => 'UserController@updateConfigNotification']);
});

Route::get("privacy", ["use" => "HomeController@privacy"]);
Route::get("service", ["use" => "HomeController@service"]);



