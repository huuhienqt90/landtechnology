<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\SellTypeResponsitory;
use Modules\Dashboard\Http\Requests\SellTypeUpdateRequest;
use Modules\Dashboard\Http\Requests\SellTypeStoreRequest;

class SellTypeController extends Controller
{
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
        $sellTypes = $this->sellTypeResponsitory->all();
        return view('dashboard::sell-type.index', compact('sellTypes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $sellType = $this->sellTypeResponsitory;
        return view('dashboard::sell-type.create', compact('sellType'));
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
        return redirect(route('dashboard.sell-type.index'))->with('alert-success', 'Create sell type sucess!');
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
        $sellType = $this->sellTypeResponsitory->find($id);
        return view('dashboard::sell-type.edit', compact('sellType'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(SellTypeUpdateRequest $request)
    {
        $update = [
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
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
