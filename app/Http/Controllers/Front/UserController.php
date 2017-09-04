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
    public function showLogin(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('front.dashboard.index');
        }
        return view('front.auth.login');
    }

    /**
     * check login
     * @return Response
    */
    public function doLogin(LoginRequest $request)
    {
        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$field => $request->input('email')]);
        $loginDT = $request->only($field, 'password');
        $loginDT['confirmed'] = 1;
        if (Auth::attempt($loginDT))
        {
            return redirect()->route('front.dashboard.index');
        }
        // validation not successful, send back to form
        Session::flash('messageError', 'You can not login because your information incorrect or you didn\'t verify your accout via email');
        return redirect()->route('front.user.login');
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
        return view('front.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RegisterRequest
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $param = $request->only(['username','email','first_name','last_name','address1','address2','country','postal_code','region']);
        $param['password'] = trim( bcrypt( $request->input('password') ) );
        $param['is_seller'] = 0;
        $param['is_buyer'] = 1;
        $param['is_notify'] = 1;
        $param['confirm_code'] = rand(10000000, 99999999);
        $id = $this->userRepository->insertGetID($param);
        if( $id != null ){
            $this->sendCode($param['email'], $param['confirm_code']);
            return redirect()->route('front.user.verify', compact('id'));
        }else{
            Session::flash('msgEr', 'Create user fail');
            return redirect()->route('front.user.login');
        }
    }

    /**
     * [sendCode description]
     * @param  [string] $email [description]
     * @param  [number] $code  [description]
     */
    public function sendCode($email, $code){
        if( !empty($email) && !empty($code) ){
            Mail::to($email)->send(new Register($code));
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
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
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

    /**
     * Show page change password of user
     */
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

    // Show page verify account
    public function showVerify($id){
        return view('front.user.verify', ['id' => $id]);
    }

    /**
     * Verify account
     * @param  Request $request [description]
     * @param  [int]  $id      [description]
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request ,$id){
        $confirm_code = $request->input('code');
        $user = $this->userRepository->find(['id' => $id, 'confirm_code' => $confirm_code])->first();
        if(count($user) == 0){
            return redirect()->route('front.user.verify')->with('msgEr','Invalid code please try again');
        }
        else{
            $this->userRepository->update(['confirm_code' => null, 'confirmed' => 1], $id);
            if(!Auth::loginUsingId($id)){
                Session::flash('messageError', 'Login incorrect');
                return redirect()->route('front.user.login');
            }
            return redirect()->route('front.dashboard.index');
        }
    }
}
