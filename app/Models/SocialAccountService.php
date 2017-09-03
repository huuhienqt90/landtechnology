<?php
namespace App\Models;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Models\User;
use App\Models\SocialAccount;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser, $driver = 'facebook')
    {
        $account = SocialAccount::whereprovider($driver)
            ->whereprovider_user_id($providerUser->getId())
            ->first();
        if ($account) {
            return [$account, $providerUser];
        } else {
            $email = !empty($providerUser->getEmail()) ? $providerUser->getEmail() : $providerUser->getId().'@'.$driver.'com';

            $user = User::whereemail($providerUser->getEmail())->first();
            if (!$user) {
                if( !empty($providerUser->getEmail()) ){
                    $user = User::create([
                        'email' => $email,
                        'last_name' => 'null',
                        'first_name' => $providerUser->getName(),
                        'address1' => 'null',
                        'password' => 'null',
                        'confirm_code' => 'null',
                        'confirmed' => 1,
                        'is_notify' => 1,
                    ]);
                }else{
                    $user = User::create([
                        'email' => $email,
                        'last_name' => 'null',
                        'first_name' => $providerUser->getName(),
                        'address1' => 'null',
                        'password' => 'null',
                        'confirm_code' => rand(10000000, 99999999),
                        'is_notify' => 1,
                        'confirmed' => 0,
                    ]);
                }

            }

            $account = new SocialAccount([
                'user_id' => $user->id,
                'provider_user_id' => $providerUser->getId(),
                'provider' => $driver,
                'email' => $email,
            ]);
            
            $account->user()->associate($user);
            $account->save();
            return [$user, $providerUser];
        }
    }
}
