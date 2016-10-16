<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;


class FacebookController extends Controller
{
    var $fb;
    //
    public function __construct(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb){
        $this->fb = $fb;
    }

    public function login(){
//        session_start();
        $app_id = \Config::get('constants.facebook_app_id');
        $app_secret = \Config::get('constants.facebook_app_secret');
        $my_url = url('/') . "/" . \Config::get('constants.facebook_redirect');  // redirect url

        $code = Input::get('code');

        if(empty($code)) {
            // Redirect to Login Dialog
            \Session::put('state', md5(uniqid(rand(), TRUE))); // CSRF protection
            $dialog_url = "https://www.facebook.com/dialog/oauth?client_id="
                . $app_id . "&redirect_uri=" . $my_url . "&state="
                . \Session::get('state') . "&scope=manage_pages,publish_actions,publish_pages";

            return view('admin.facebook',['url' => $dialog_url]);
        }
        if(\Session::has('state') && (\Session::get('state') === Input::get('state'))) {
            try{
                $token_url = "https://graph.facebook.com/oauth/access_token?"
                    . "client_id=" . $app_id . "&redirect_uri=" . $my_url
                    . "&client_secret=" . $app_secret . "&code=" . $code;

                $response = file_get_contents($token_url);
                $params = null;
                parse_str($response, $params);
                $longtoken=$params['access_token'];

                \Storage::put(
                    \Config::get("constants.facebook_token_file"),
                    $longtoken
                );

                dd("Eureka");
            }
            catch(Exception $e){
                dd($e->getMessage());
            }

//            return view('admin.facebook',['token' => $longtoken]);
//save it to database
        }
    }

    public function post(){
        try {
            $id = \Config::get('constants.FacebookPageId');

            $exists = \Storage::exists(\Config::get('constants.facebook_token_file'));
            if($exists) {
                $access_token = \Storage::get(\Config::get('constants.facebook_token_file'));
                $this->fb->setDefaultAccessToken($access_token); // sets our access token as the access token when we call something using the SDK, which we are going to do now.
                try {
                    $response = $this->fb->get('/me/accounts');
//                    dd($response->getDecodedBody());

                    $page_access_token = "";
                    foreach ($response->getDecodedBody()["data"] as $page) {
//                        echo($page["id"] . " " . \Config::get("constants.facebook_page_id"));
                        if ($page["id"] == \Config::get("constants.facebook_page_id")) {
                            $page_access_token = $page["access_token"];
                            //echo '<br>';
                            //echo "2. ".$page_access_token;
                            break;
                        }
                    }

                    $this->fb->setDefaultAccessToken($page_access_token);

                    $args = array(
                        'access_token' => $page_access_token,
                        'message' => "Cheek of the week is returning soon",
                        'name' => "Just so you know",
                        'link' => "http://caleb.com.ng",
                        'actions' => json_encode([
                            'name' => 'Loading...',
                            'link' => "http://caleb.com.ng"
                        ])
                    );

                    $response = $this->fb->post("/$id/feed", $args);

                    $graphNode = $response->getGraphNode();

                    dd('Posted with id: ' . $graphNode['id'], $response);
                } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                    dd($e->getMessage());
                }
            }
            else{
                dd("Shing");
            }
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }
}
