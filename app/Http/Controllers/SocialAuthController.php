<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver(\SocialiteConstant::facebook)->redirect();
    }

    public function callback(SocialAccountService $service)
    {
        // when facebook call us a with token
        $user = $service->createOrGetUser(Socialite::driver(\SocialiteConstant::facebook)->user());

        auth()->login($user);

        return redirect()->to('/profile');
    }
}
