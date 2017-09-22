<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\Register;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'    => 'required|email|unique:users,email',
            'username' => 'required|min:5|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required',
            'last_name' => 'required',
            'address1' => 'required',
            'country' => 'required',
            'postalcode' => 'numeric'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $param['username'] = $data['username'];
        $param['email'] = $data['username'];
        $param['first_name'] = $data['first_name'];
        $param['last_name'] = $data['last_name'];
        $param['address1'] = $data['address1'];
        $param['address2'] = $data['address2'];
        $param['country'] = $data['country'];
        $param['postal_code'] = $data['postal_code'];
        //$param['region'] = $data['region'];
        $param['password'] = trim( bcrypt( $data['password'] ) );
        $param['is_seller'] = 0;
        $param['is_buyer'] = 1;
        $param['is_notify'] = 1;
        $param['confirm_code'] = rand(10000000, 99999999);
        $user = User::create($param);
        if( $user->id != null ){
            if( !empty($param['email']) && !empty($param['confirm_code']) ){
                Mail::to($param['email'])->send(new Register($param['confirm_code']));
            }
            return redirect()->route('front.user.verify', compact('id'));
        }else{
            Session::flash('msgEr', 'Create user fail');
            return redirect()->route('front.user.login');
        }
    }
}
