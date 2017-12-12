<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Repositories\UserResponsitory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\Http\Requests\UserStoreRequest;
use Modules\Dashboard\Http\Requests\UserUpdateRequest;

class UserController extends DashboardController
{
    protected $menuActive = 'users';
    protected $subMenuActive = 'user';

    protected $userReponsitory;
    public function __construct(UserResponsitory $userResponsitory)
    {
        $this->userReponsitory = $userResponsitory;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = $this->userReponsitory->all();
        return $this->viewDashboard('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = $this->userReponsitory;
        return $this->viewDashboard('user.create', compact('user'));
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

        $id = $this->userReponsitory->insertGetID($param);
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
        return $this->viewDashboard('show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userReponsitory->find($id);
        return $this->viewDashboard('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userReponsitory->find( $id );
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
        $arItem = $this->userReponsitory->find($id);
        if($arItem->avatar != null){
            \Storage::delete($arItem->avatar);
        }
        $arItem->delete();
        return redirect(route('dashboard.user.index'))->with('alert-success', 'Delete user success');
    }

    public function deleteAvatar($id){
        $arItem = $this->userReponsitory->find($id);
        if($arItem->avatar != null){
            \Storage::delete($arItem->avatar);
        }
        $arItem['avatar'] = null;
        $arItem->update();
        return ['success' => true];
    }

    /**
     * [getCustomerUser description]
     * @param  Request $request [description]
     * @return json
     */
    public function getCustomerUser(Request $request)
    {
        if($request->ajax()){

            $name = trim($request->q);

            if (empty($name)) {
                return response()->json([]);
            }

            $names = $this->userReponsitory->getUserByName($name);

            $customerUserArr = [];

            foreach($names as $item){
                $res = new \stdClass;
                $res->id = $item->id;
                $res->text = $item->username;
                $customerUserArr[] = $res;
            }

            return response()->json($customerUserArr);
        }
    }

    public function getInfoBill(Request $request)
    {
        if( $request->ajax() ) {
            $id = $request->id;
            $user = $this->userReponsitory->find($id);

            if (empty($user)) {
                return response()->json([]);
            }

            return response()->json($user);
        }
    }
}
