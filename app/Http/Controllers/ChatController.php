<?php

namespace App\Http\Controllers;
//use App\Chat;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Request;
use LRedis;

class ChatController extends Controller {
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
            'id_user_to' => Request::input('id_user_to'),
            'time' => Carbon::now()->toDateTimeString()
        ];

        $redis->lpush('message', json_encode($data));
        $redis->publish('message', json_encode($data));
        return response()->json([]);
    }
}
