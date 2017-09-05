<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\AttributeGroupResponsitory;
use App\Repositories\UserResponsitory;
use Modules\Dashboard\Http\Requests\AttributeGroupUpdateRequest;
use Modules\Dashboard\Http\Requests\AttributeGroupStoreRequest;

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
        $sellerArr = [];
        if( $sellers->count() ){
            foreach ($sellers as $seller) {
                $sellerArr[$seller->id] = $seller->getFullName();
            }
        }

        $sellers = $this->userResponsitory->getUsersNotMatch(1);
        $sellerArr = [];
        if( $sellers->count() ){
            foreach ($sellers as $seller) {
                $sellerArr[$seller->id] = $seller->getFullName();
            }
        }

        return view('dashboard::attribute-group.create', compact('attributeGroup', 'sellerArr'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
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
    public function edit()
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
