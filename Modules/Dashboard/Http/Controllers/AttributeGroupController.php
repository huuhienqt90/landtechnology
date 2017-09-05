<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\AttributeGroupResponsitory;
use App\Repositories\UserResponsitory;
use Modules\Dashboard\Http\Requests\AttributeGroupRequest;
use Auth;

class AttributeGroupController extends Controller
{
    protected $attrGroupResponsitory;
    protected $userResponsitory;
    public function __construct(AttributeGroupResponsitory $attrGroupResponsitory, UserResponsitory $userResponsitory){
        $this->attrGroupResponsitory = $attrGroupResponsitory;
        $this->userResponsitory = $userResponsitory;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $attributeGroups = $this->attrGroupResponsitory->all();
        return view('dashboard::attribute-group.index', compact('attributeGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $attributeGroup = $this->attrGroupResponsitory;
        $sellers = $this->userResponsitory->findAllBy('is_seller', 1);
        $sellerArr = ['' => 'Select a seller'];
        if( $sellers->count() ){
            foreach ($sellers as $seller) {
                $sellerArr[$seller->id] = $seller->getFullName();
            }
        }

        $attributesGroup = $this->attrGroupResponsitory->all();
        $attributesGroupArr = ['' => 'Select a parent'];
        if( $attributesGroup->count() ){
            foreach ($attributesGroup as $attr) {
                $attributesGroupArr[$attr->id] = $attr->name;
            }
        }

        $listTypes = $this->attrGroupResponsitory->listTypes();
        return view('dashboard::attribute-group.create', compact('attributeGroup', 'sellerArr', 'attributesGroupArr', 'listTypes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(AttributeGroupRequest $request)
    {
        $create = $request->only(['name', 'type', 'value']);
        $create['seller_id'] = $request->seller_id == null ? Auth::user()->id : $request->seller_id;
        if( $request->parent != null ) {
            $create['parent'] = $request->parent;
        }
        $this->attrGroupResponsitory->create($create);
        return redirect(route('dashboard.attribute-group.index'))->with('alert-success', 'Create attribute group sucess!');
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
        $sellers = $this->userResponsitory->findAllBy('is_seller', 1);
        $sellerArr = ['' => 'Select a seller'];
        if( $sellers->count() ){
            foreach ($sellers as $seller) {
                $sellerArr[$seller->id] = $seller->getFullName();
            }
        }

        $attributesGroup = $this->attrGroupResponsitory->getParent($id);
        $attributesGroupArr = ['' => 'Select a parent'];
        if( $attributesGroup->count() ){
            foreach ($attributesGroup as $attr) {
                $attributesGroupArr[$attr->id] = $attr->name;
            }
        }

        $listTypes = $this->attrGroupResponsitory->listTypes();
        $attributeGroup = $this->attrGroupResponsitory->find($id);
        return view('dashboard::attribute-group.edit', compact('attributeGroup','sellerArr','attributesGroupArr','listTypes'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(AttributeGroupRequest $request, $id)
    {
        $update = $request->only(['name', 'type', 'value']);
        $update['seller_id'] = $request->seller_id == null ? Auth::user()->id : $request->seller_id;
        if( $request->parent != null ) {
            $update['parent'] = $request->parent;
        }
        $this->attrGroupResponsitory->update($update, $id);
        return redirect(route('dashboard.attribute-group.index'))->with('alert-success', 'Update attribute group success!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $arItem = $this->attrGroupResponsitory->find($id);
        $arItem->delete();
        return redirect(route('dashboard.attribute-group.index'))->with('alert-success', 'Delete attribute group success');
    }
}
