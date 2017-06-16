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



// UI routes
Route::get('/', array('uses'=>'UIController@home', 'as' => 'index'));
Route::get('app', array('uses'=>'UIController@app', 'as' => 'app'));
Route::get('app/profile', array('uses'=>'UIController@profile', "as"=>"profile"));
Route::get('profile/{id}',["as" => "my_profile", "uses" => 'UIController@myProfile']);
Route::get('faq', ['as' => 'faq', 'uses' => 'UIController@faq']);
Route::get('privacy/policy', array("as" => "policy", "uses" => "UIController@policy"));

Route::resource('photo', 'PhotoController');
Route::post('login', array("as" => "login", "uses" => 'LoginController@login'));
Route::post('vote','VoteController@vote');
Route::get('spot/{url}',[ 'uses' => 'VenueController@redirect', 'as' => 'spot_redirect']);
//Route::get('seed','HomeController@seed');

Route::get('cheeks/{total}', array("as" => "cheeks", "uses" => 'HomeController@getContestants'));
Route::post('update/status','PhotoController@updateStatus');
Route::post('upload/photo', ["as" => "photo_upload", "uses" => 'PhotoController@storeImgFromString']);
Route::post('account-update', ["as" => "account-update", 'uses' => 'ProfileController@updateAccountDetails']);

Route::get('delete/{id}/photo',["as" => "delete_pic", "uses" =>'PhotoController@destroy']);  //delete photo

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
    Route::get('daily/poll', array("uses" => 'VoteController@dailyPollStat'));
});


/*
 * Chat routes
 */
Route::post('sendmessage', ['as' => 'chat-url', 'uses' => 'ChatController@sendMessage']);
