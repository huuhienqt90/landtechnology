<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Repositories\UserResponsitory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Http\Requests\UserStoreRequest;
use Modules\Dashboard\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserResponsitory $userResponsitory)
    {
        $this->userRepository = $userResponsitory;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = $this->userRepository->all();
        return view('dashboard::user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = $this->userRepository;
        return view('dashboard::user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(UserStoreRequest $request)
    {
        $param = $request->only(['username','email','first_name','last_name','address1','address2','country','postal_code','region']);
        $param['password'] = trim( bcrypt( $request->input('password') ) );
        $param['is_seller'] = 0;
        $param['is_buyer'] = 1;
        $param['is_notify'] = 1;
        $param['confirmed'] = 1;

        if($request->hasFile('avatar')){
            $path = $request->file('avatar')->store('users/avatar');
            $param['avatar'] = $path;
        }

        $id = $this->userRepository->insertGetID($param);
        if( $id != null ){
            return redirect(route('dashboard.user.index'))->with('alert-success', 'Create user success!');
        }else{
            return redirect(route('dashboard.user.index'))->with('alert-danger', 'Cant create user!');
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        return view('dashboard::user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userRepository->find( $id );
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->country = $request->country;
        $user->postal_code = $request->postal_code;
        if($request->password != null){
            $user->password = trim( bcrypt( $request->input('password') ) );
        }
        if($request->hasFile('avatar')){
            if($user->avatar != null){
                \Storage::delete($user->avatar);
            }
            $path = $request->file('avatar')->store('users/avatar');
            $user->avatar = $path;
        }
        $result = $user->update();
        if($result) {
            return redirect(route('dashboard.user.index'))->with('alert-success', 'Update user success!');
        }else{
            return redirect(route('dashboard.user.index'))->with('alert-success', 'Cant update user!');
        }

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $arItem = $this->userRepository->find($id);
        if($arItem->avatar != null){
            \Storage::delete($arItem->avatar);
        }
        $arItem->delete();
        return redirect(route('dashboard.user.index'))->with('alert-success', 'Delete user success');
    }

    public function deleteAvatar($id){
        $arItem = $this->userRepository->find($id);
        if($arItem->avatar != null){
            \Storage::delete($arItem->avatar);
        }
        $arItem['avatar'] = null;
        $arItem->update();
        return ['success' => true];
    }
}
