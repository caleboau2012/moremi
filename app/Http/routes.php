<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', array("as" => "home", "uses" => 'HomeController@index'));
Route::get('profile', array("as" => "profile", "uses" => 'ProfileController@profile'));

Route::post('photo/fb', 'PhotoController@storefb');

Route::resource('photo', 'PhotoController');
Route::post('login', array("as" => "login", "uses" => 'LoginController@login'));
Route::post('vote','VoteController@vote');
Route::get('test','HomeController@test');
Route::get('seed','HomeController@seed');
Route::get('cheeks/{total}', array("as" => "cheeks", "uses" => 'HomeController@getContestants'));
Route::get('cron_post', array("as" => 'cron_post', 'uses' => 'FacebookController@post'));
Route::get('facebook_redirect', ["as" => "facebook_redirect", "uses" => 'FacebookController@login']);
Route::post('update/status','PhotoController@updateStatus');
Route::post('upload/photo', ["as" => "photo_upload", "uses" => 'PhotoController@storeImgFromString']);

Route::get('myprofile','ProfileController@myProfile');
