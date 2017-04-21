<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use LRedis;

class chatController extends Controller {
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function sendMessage(){
        $redis = LRedis::connection();
        $data = [
            'message' => Request::input('message'),
            'user' => Request::input('user'),
            'id_user_from' => Request::input('id_user_from'),
            'id_user_to' => Request::input('id_user_to')
        ];
        $redis->publish('message', json_encode($data));
        return response()->json([]);
    }
}
