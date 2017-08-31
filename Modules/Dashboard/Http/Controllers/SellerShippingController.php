<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\SellerShippingResponsitory;
use Modules\Dashboard\Http\Requests\SellerShippingUpdateRequest;
use Modules\Dashboard\Http\Requests\SellerShippingStoreRequest;

class SellerShippingController extends Controller
{
    protected $sellerShippingResponsitory;
    public function __construct(SellerShippingResponsitory $sellerShippingResponsitory){
        $this->sellerShippingResponsitory = $sellerShippingResponsitory;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sellerShippings = $this->sellerShippingResponsitory->all();
        return view('dashboard::seller-shipping.index', compact('sellerShippings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $sellerShipping = $this->sellerShippingResponsitory;
        return view('dashboard::seller-shipping.create', compact('sellerShipping'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(SellerShippingStoreRequest $request)
    {
        $create = ['seller_id' => auth()->user()->id, 'from_country' => $request->from_country, 'to_country' => $request->to_country, 'cost' => $request->cost];
        $this->sellerShippingResponsitory->create($create);
        return redirect(route('dashboard.seller-shipping.index'))->with('alert-success', 'Create seller shipping sucess!');
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
        $sellerShipping = $this->sellerShippingResponsitory->find($id);
        return view('dashboard::seller-shipping.edit', compact('sellerShipping'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(SellerShippingUpdateRequest $request, $id)
    {
        $update = ['seller_id' => auth()->user()->id, 'from_country' => $request->from_country, 'to_country' => $request->to_country, 'cost' => $request->cost];
        $this->sellerShippingResponsitory->update($update, $id);
        return redirect(route('dashboard.seller-shipping.index'))->with('alert-success', 'Update seller shipping sucess!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $arItem = $this->sellerShippingResponsitory->find($id);
        $arItem->delete();
        return redirect(route('dashboard.seller-shipping.index'))->with('alert-success', 'Delete seller shipping success');
    }
}
