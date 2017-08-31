<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserResponsitory;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Auth;

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
            return redirect()->route('dashboard');
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
        $password = trim( bcrypt($request->input('password')) );
        
        // create our user data for the authentication
        $userdata = array(
            'email'     => $email,
            'password'  => $password
        );

        // attempt to do the login
        if (Auth::attempt($userdata)) {
             return redirect()->route('dashboard');

        } else {        

            // validation not successful, send back to form 
            Session::flash('messageError', 'User\'s sell is correct.');
            return redirect()->route('login');

        }
    }
    /**
     * Logout.
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $param = $request->only(['email','first_name','last_name','address1','address2','country','postal_code','region']);
        $param['password'] = trim( bcrypt( $request->input('password') ) );
        $param['is_seller'] = 1;
        $param['is_buyer'] = 0;
        $param['confirm_code'] = rand(10000000, 99999999);
        $result = $this->userRepository->create($param);
        if($result){
            Session::flash('msg', 'Please activate your account. Email has been sent to '. $param['email']. ' check your inbox in order to activate and login into your account');
            return redirect('login')->with('success', 'Please check your inbox in order to activate and login into your account');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
