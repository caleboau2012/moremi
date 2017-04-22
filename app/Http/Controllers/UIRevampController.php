<?php

namespace App\Http\Controllers;

class UIRevampController extends Controller
{

    public function __construct() {

    }

    public function home(){
        return view('uirevamp.home');
    }

}
