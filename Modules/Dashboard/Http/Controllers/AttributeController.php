<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\AttributeResponsitory;
use App\Repositories\AttributeGroupResponsitory;
use App\Repositories\UserResponsitory;
use Modules\Dashboard\Http\Requests\AttributeRequest;

class AttributeController extends Controller
{
    protected $attributeResponsitory;
    protected $attributeGroupResponsitory;

    public function __construct(AttributeResponsitory $attributeResponsitory,
                                AttributeGroupResponsitory $attributeGroupResponsitory)
    {
        $this->attributeResponsitory = $attributeResponsitory;
        $this->attributeGroupResponsitory = $attributeGroupResponsitory;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $attributes = $this->attributeResponsitory->all();
        return view('dashboard::attribute.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $attribute = $this->attributeResponsitory;
        $attrGroups = $this->attributeGroupResponsitory->all();
        $arrAttrGroups = ['' => 'Select a attribute group'];
        foreach($attrGroups as $item){
            $arrAttrGroups[$item->id] = $item->name;
        }
        return view('dashboard::attribute.create', compact('arrAttrGroups','attribute'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(AttributeRequest $request)
    {
        $param = $request->all();
        $this->attributeResponsitory->create($param);
        return redirect(route('dashboard.attribute.index'))->with('alert-success', 'Create attribute sucess!');
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
        $attribute = $this->attributeResponsitory->find($id);
        $attrGroups = $this->attributeGroupResponsitory->all();
        $arrAttrGroups = ['' => 'Select a attribute group'];
        foreach($attrGroups as $item){
            $arrAttrGroups[$item->id] = $item->name;
        }
        return view('dashboard::attribute.edit', compact('arrAttrGroups','attribute'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(AttributeRequest $request, $id)
    {
        $param = $request->only(['group_id','name','options']);
        $this->attributeResponsitory->update($param, $id);
        return redirect(route('dashboard.attribute.index'))->with('alert-success', 'Update attribute sucess!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $arItem = $this->attributeResponsitory->find($id);
        $arItem->delete();
        return redirect(route('dashboard.attribute.index'))->with('alert-success', 'Delete attribute group success');
    }
}
