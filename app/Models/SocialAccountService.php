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
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $driver,
                'email' => $email,
            ]);
            $user = User::whereemail($providerUser->getEmail())->first();
            if (!$user) {
                if( !empty($providerUser->getEmail()) ){
                    $user = User::create([
                        'email' => $email,
                        'first_name' => $providerUser->getName(),
                        'confirm_code' => 'null',
                        'confirmed' => 1,
                    ]);
                }else{
                    $user = User::create([
                        'email' => $email,
                        'first_name' => $providerUser->getName(),
                        'confirm_code' => rand(10000000, 99999999),
                        'confirmed' => 0,
                    ]);
                }

            }
            $account->user()->associate($user);
            $account->save();
            return [$user, $providerUser];
        }
    }
}
