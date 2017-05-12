<?php

namespace App\Http\Controllers;

class UIRevampController extends Controller
{

    public function __construct() {

    }

    public function home(){
        return view('uirevamp.home');
    }
    /*user homepage*/
    public function user(){
        return view('uirevamp.user');
    }

}
