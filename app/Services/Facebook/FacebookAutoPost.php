<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 10/25/2016
 * Time: 5:38 PM
 */

namespace app\Services\Facebook;


use App\OldCheek;
use App\Profile;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions;

class FacebookAutoPost implements  IFacebookAutoPost
{
   protected  $fb;
    protected $cheek;
    protected $profile;
    public  function __construct(LaravelFacebookSdk $fb,OldCheek $cheek){
    $this->fb=$fb;
    $this->$cheek=$cheek;
   $this->profile =Profile::find($cheek->profile_id);
    }


   public  function login(){
   }

    public function post(){

        try {
            $id = config('constants.FacebookPageId');

            $access_token = $this->getLoginToken();
            if($access_token!="") {
                $this->fb->setDefaultAccessToken($access_token); // sets our access token as the access token when we call something using the SDK, which we are going to do now.
                try {
                    $response = $this->fb->get('/me/accounts');
//                    dd($response->getDecodedBody());
                    $page_access_token = "";
                    foreach ($response->getDecodedBody()["data"] as $page) {
//                        echo($page["id"] . " " . \Config::get("constants.facebook_page_id"));
                        if ($page["id"] == config("constants.facebook_page_id")) {
                            $page_access_token = $page["access_token"];
                            //echo '<br>';
                            //echo "2. ".$page_access_token;
                            break;
                        }
                    }
                   // if($this->getLoginToken()!=''){
                    $this->fb->setDefaultAccessToken($page_access_token);
                    $args = array(
                        'access_token' => $page_access_token,
                        'message' => "Cheek of the week is returning soon",
                        'name' => $this->profile->first_name." ".$this->profile->last_name,
                        'link' => url(),
                        'actions' => json_encode([
                            'name' => 'Loading...',
                            'link' => "http://caleb.com.ng"
                        ])
                    );
                    $response = $this->fb->post("/$id/feed", $args);

                    $graphNode = $response->getGraphNode();
                    $this->savePostId($graphNode['id']); ///save post Id in to Db
                    dd('Posted with id: ' . $graphNode['id'], $response);
                    $this->savePostId($graphNode['id']);
                } catch (Exceptions\FacebookSDKException $e) {
                    dd($e->getMessage());
                }
            }
            else{
                dd("Shing");
            }
        } catch(Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

    public  function saveLoginToken($token){
        Storage::put(
            config("constants.facebook_token_file"),
            $token
        );
    }

    public function getLoginToken(){
       $exist= Storage::exists(config('constants.facebook_token_file'));
        if($exist){
                return Storage::get(config('constants.facebook_token_file'));
        }
    }


    public  function savePostId($id){
        $cheek =$this->cheek;
        $cheek->facebook_post_id =$id;
        $cheek->update();
    }

}
