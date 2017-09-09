<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Socialite;
use App\Models\SocialAccountService;
use App\Models\SocialAccount;
use App\Models\User;
use Auth;

class SocialAuthController extends Controller
{
    public function redirect($driver = 'facebook'){
        return Socialite::driver($driver)->redirect();
    }

    public function callback(SocialAccountService $service, $driver='facebook'){
        if( $driver == 'twitter' ){
            list($user, $provider) = $service->createOrGetUser(Socialite::driver($driver)->user(), $driver);
        }else{
            list($user, $provider) = $service->createOrGetUser(Socialite::driver($driver)->stateless()->user(), $driver);
        }
        if(!empty($user->user_id)){
            Auth::loginUsingId($user->user_id);
            return redirect()->route('front.dashboard.index');
        }else{
            Auth::loginUsingId($user->id);
            return redirect()->route('front.user.edit')->with('msgOk','Please fill complete information of my account');
        }
        if( !empty($provider->getEmail()) ){
            return redirect()->route('front.dashboard.index');
        }else{
            return redirect()->route('front.user.edit');
        }
    }
}
