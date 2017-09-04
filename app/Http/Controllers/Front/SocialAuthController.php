<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Socialite;
use Session;
use App\SocialAccountService;
use App\Models\SocialAccount;
use App\Models\User;

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
        if(!empty($user->id)){
            session()->regenerate();
            session(['usertype' => 'buyer', 'id' => $user->id]);
        }else{
            $user_ids = User::where('email', $user->email)->first();
            SocialAccount::where('email',$user->email)->update(['id' => $user_ids->id]);
            session()->regenerate();
            session(['usertype' => 'buyer', 'id' => $user_ids->id]);
        }
        if( !empty($provider->getEmail()) ){
            return redirect('/buyerdashboard');
        }else{
            session(['usertype' => 'pending']);
            return redirect('/update-profile');
        }
    }
}
