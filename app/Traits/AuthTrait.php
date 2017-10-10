<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 2/16/2017
 * Time: 10:43 AM
 */

namespace App\Traits;


use App\Services\UserService;

trait AuthTrait
{
    protected  $request;
    protected  $auth=false;
    protected $_userId;
    protected $activeProfile;


    public  function authenticate(){
        if(session('authToken')!=null) {
            $this->setAuth(session('authToken'));
            return;
        }

        if($this->request)
            $access_token = $this->request->header('authToken');
        else
            $access_token = null;

        if($access_token!=null){
            $this->setAuth($access_token);
        }
    }

    public  function setAuth($token)
    {
        $userId = customdecrypt($token);
        $userInstance = UserService::instance();
        $checkUser = $userInstance->isValid($userId);
        if ($checkUser) {
            $this->auth = true;
            $this->_userId = $userId;
            $this->activeProfile = $checkUser;
        }
    }

}