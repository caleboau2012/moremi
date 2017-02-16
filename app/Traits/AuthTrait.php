<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 2/16/2017
 * Time: 10:43 AM
 */

namespace app\Traits;


use App\Services\UserService;

trait AuthTrait
{
    protected  $request;
    protected  $auth=false;
    protected $_userId;


    public  function authenticate(){
        if(session('authToken')!=null) {
            $this->setAuth(session('authToken'));
        }
        $access_token = $this->request->header('authToken');
        if($access_token!=null){
            $this->setAuth($access_token);
        }
    }

    public  function setAuth($token)
    {
        $userId = customdecrypt($token);
        $userInstance = UserService::instance();
        if ($userInstance->isValid($userId)) {
            $this->auth = true;
            $this->_userId = $userId;
        }
    }

}