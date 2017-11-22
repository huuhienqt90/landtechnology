<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\SellTypeResponsitory;
use Modules\Dashboard\Http\Requests\SellTypeUpdateRequest;
use Modules\Dashboard\Http\Requests\SellTypeStoreRequest;

class SellTypeController extends DashboardController
{
    protected $menuActive = 'products';
    protected $subMenuActive = 'sell-type';

    protected $sellTypeResponsitory;
    public function __construct(SellTypeResponsitory $sellTypeResponsitory){
        $this->sellTypeResponsitory = $sellTypeResponsitory;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sellTypes = $this->sellTypeResponsitory->getSellTypesByUser(auth()->user()->id, 20);
        return $this->viewDashboard('sell-type.index', compact('sellTypes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $sellType = $this->sellTypeResponsitory;
        return $this->viewDashboard('sell-type.create', compact('sellType'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(SellTypeStoreRequest $request)
    {
        $create = ['name' => $request->name, 'created_by' => auth()->user()->id, 'updated_by' => auth()->user()->id];
        $this->sellTypeResponsitory->create($create);
        return redirect(route('dashboard.sell-type.index'))->with('alert-success', 'Create sell type success!');
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
        $sellType = $this->sellTypeResponsitory->find($id);
        return $this->viewDashboard('sell-type.edit', compact('sellType'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(SellTypeUpdateRequest $request, $id)
    {
        $update = [
            'name' => $request->name,
            'updated_by' => auth()->user()->id,
            'slug' => $request->slug
        ];
        $this->sellTypeResponsitory->update($update, $id);
        return redirect(route('dashboard.sell-type.index'))->with('alert-success', 'Update sell type sucess!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $arItem = $this->sellTypeResponsitory->find($id);
        $arItem->delete();
        return redirect(route('dashboard.sell-type.index'))->with('alert-success', 'Delete sell type success');
    }
}
