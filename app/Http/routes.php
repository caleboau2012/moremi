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
Route::get('privacy/policy', array("as" => "policy", "uses" => "HomeController@policy"));

Route::post('photo/fb', 'PhotoController@storefb');

Route::resource('photo', 'PhotoController');
Route::post('login', array("as" => "login", "uses" => 'LoginController@login'));
Route::post('vote','VoteController@vote');
Route::get('test','HomeController@test');
Route::get('seed','HomeController@seed');
Route::get('cheeks/{total}', array("as" => "cheeks", "uses" => 'HomeController@getContestants'));
Route::post('update/status','PhotoController@updateStatus');
Route::post('upload/photo', ["as" => "photo_upload", "uses" => 'PhotoController@storeImgFromString']);
Route::post('account-update', ["as" => "account-update", 'uses' => 'ProfileController@updateAccountDetails']);

Route::get('delete/{id}/photo',["as" => "delete_pic", "uses" =>'PhotoController@destroy']);  //delete photo
Route::get('myprofile',["as" => "my_profile", "uses" => 'ProfileController@myProfile']);

/*
 * Paystack
 */
Route::post('/pay', [
    'uses' => 'PaymentController@redirectToGateway',
    'as' => 'pay'
]);
Route::get('/payment/callback', ["as" => "payment_callback", "uses" => 'PaymentController@handleGatewayCallback']);

/*CRON Activities*/
Route::group(['prefix' => 'cron'], function(){
    Route::get('end/votes', array("uses" => 'VoteController@endVotes'));
    Route::get('fetch/venue-previews', array("uses" => 'VenueController@fetchPreviews'));
});


/*
 * Chat routes
 */
Route::post('sendmessage', ['as' => 'chat-url', 'uses' => 'ChatController@sendMessage']);
/*
 *
 * UI REVAMP
 * PROOF OF CONCEPT
 */
Route::group(['prefix' => 'ui'], function(){
   Route::get('home', array('uses'=>'UIRevampController@home'));
});
