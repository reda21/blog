<?php

Route::get('test', "TestController@test");
Route::post("test/profile", "TestController@profile");
Route::get('rest2/{id?}', "TestController@rest2");
