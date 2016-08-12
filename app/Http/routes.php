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



Route::get('/', 'HomeController@index');

Route::get('profile', array("as" => "profile", "uses" => 'HomeController@profile'));

Route::resource('photo', 'PhotoController');

Route::post('login', array("as" => "login", "uses" => 'LoginController@login'));

Route::post('vote','VoteController@vote');

Route::get('cheeks','HomeController@getAll');

Route::get('seed','HomeController@seed');

Route::get('profiles/{total}', 'HomeController@getContestants');