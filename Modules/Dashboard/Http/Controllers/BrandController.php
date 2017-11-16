<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\BrandResponsitory;
use Modules\Dashboard\Http\Requests\BrandUpdateRequest;
use Modules\Dashboard\Http\Requests\BrandStoreRequest;

class BrandController extends DashboardController
{
    protected $menuActive = 'products';
    protected $subMenuActive = 'brand';
    protected $brandResponsitory;
    public function __construct(BrandResponsitory $brandResponsitory){
        $this->brandResponsitory = $brandResponsitory;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $brands = $this->brandResponsitory->all();
        return $this->viewDashboard('brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $brand = $this->brandResponsitory;
        return $this->viewDashboard('brand.create', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(BrandStoreRequest $request)
    {
        $create = ['name' => $request->name, 'created_by' => auth()->user()->id, 'updated_by' => auth()->user()->id];
        if( $request->hasFile('image') ){
            $path = $request->file('image')->store('brands');
            $create['image'] = $path;
        }
        $this->brandResponsitory->create($create);
        return redirect(route('dashboard.brand.index'))->with('alert-success', 'Create brand success!');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return $this->viewDashboard('index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $brand = $this->brandResponsitory->find($id);
        return $this->viewDashboard('brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(BrandUpdateRequest $request, $id)
    {
        $update = [
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ];
        if( $request->hasFile('image') ){
            $path = $request->file('image')->store('brands');
            $update['image'] = $path;
        }
        $this->brandResponsitory->update($update, $id);
        return redirect(route('dashboard.brand.index'))->with('alert-success', 'Update brand success!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $arItem = $this->brandResponsitory->find($id);
        $this->brandResponsitory->deleteProductsByBrandId($id);
        $arItem->delete();
        return redirect(route('dashboard.brand.index'))->with('alert-success', 'Delete brand success');
    }
}
