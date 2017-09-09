<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Repositories\RoleResponsitory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Http\Requests\RoleStoreRequest;
use Modules\Dashboard\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    protected $roleRepository;
    public function __construct(RoleResponsitory $roleResponsitory)
    {
        $this->roleRepository = $roleResponsitory;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roles = $this->roleRepository->all();
        return view('dashboard::role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $role = $this->roleRepository;
        return view('dashboard::role.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(RoleStoreRequest $request)
    {
        $create = ['name' => $request->name, 'slug' => $request->slug];
        $this->roleRepository->create($create);
        return redirect(route('dashboard.role.index'))->with('alert-success', 'Create role success!');
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
        $role = $this->roleRepository->find($id);
        return view('dashboard::role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $update = [
            'name' => $request->name,
            'slug' => $request->slug
        ];
        $this->roleRepository->update($update, $id);
        return redirect(route('dashboard.role.index'))->with('alert-success', 'Update role success!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $arItem = $this->roleRepository->find($id);
        $arItem->delete();
        return redirect(route('dashboard.role.index'))->with('alert-success', 'Delete role success');
    }
}
