<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserResponsitory;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Auth;
use App\Mail\Register;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $userRepository;
    public function __construct(UserResponsitory $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display login page
     * @return Response
    */
    public function showLogin()
    {
        if(Auth::check()){
            return redirect()->route('front.dashboard.index');
        }
        return view('layouts.front.login');
    }

    /**
     * check login
     * @return Response
    */
    public function doLogin(LoginRequest $request)
    {
        $email = trim( $request->input('email') );
        $password = trim( $request->input('password') );
        
        // create our user data for the authentication
        $userdata = array(
            'email'     => $email,
            'password'  => $password
        );

        // attempt to do the login
        if (Auth::attempt($userdata)) {
             return redirect()->route('front.dashboard.index');
        } else {
            // validation not successful, send back to form 
            Session::flash('messageError', 'Email or password incorrect');
            return redirect()->route('front.user.login');

        }
    }
    /**
     * Logout.
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.front.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RegisterRequest
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $param = $request->only(['email','first_name','last_name','address1','address2','country','postal_code','region']);
        $param['password'] = trim( bcrypt( $request->input('password') ) );
        $param['is_seller'] = 0;
        $param['is_buyer'] = 1;
        $param['is_notify'] = 1;
        $param['confirm_code'] = rand(10000000, 99999999);
        $result = $this->userRepository->create($param);
        if($result){
            Mail::to($param['email'])->send(new Register($param));
            Session::flash('msgOk', 'Please activate your account. Email has been sent to '. $param['email']. ' check your inbox in order to activate and login into your account');
            return redirect()->route('front.index');
            // with('msg', 'Please check your inbox in order to activate and login into your account');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        return view('front.user.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $user = $this->userRepository->find( Auth::user()->id );
        // $user = $request->only(['first_name', 'last_name', 'address1', 'address2', 'country', 'postal_code']);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->country = $request->country;
        $user->postal_code = $request->postal_code;
        $result = $user->update();
        if($result) {
            Session::flash('msgOk','Update infomation complete.');
            return redirect()->route('front.user.edit');
        }else{
            Session::flash('msgEr','Update infomation fail');
            return redirect()->route('front.user.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editPass(){
        return view('front.user.password');
    }

    public function updatePass(UpdatePasswordRequest $request){
        $user = $this->userRepository->find( Auth::user()->id );
        if( $request->password_new != null) {
            $user->password = trim( bcrypt($request->input('password_new')) );
        }
        $result = $user->update();
        if($result) {
            Session::flash('msgOk','Update password complete.');
            return redirect()->route('front.user.editPass');
        }else{
            Session::flash('msgEr','Update password fail');
            return redirect()->route('front.user.editPass');
        }
    }
}
