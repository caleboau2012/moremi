<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 10/25/2016
 * Time: 5:38 PM
 */

namespace app\Services\Facebook;


interface IFacebookAutoPost
{

    public  function login();

    public  function post();

    public  function saveLoginToken($token);

    public  function getLoginToken();

    public  function savePostId($id);

}