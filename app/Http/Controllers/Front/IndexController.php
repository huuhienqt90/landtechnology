<?php

namespace App\Http\Controllers\Front;

use App\Repositories\ProductResponsitory;
use App\Repositories\HuntingResponsitory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    protected $productRepository;
    public function __construct(ProductResponsitory $productResponsitory,
                                HuntingResponsitory $huntingResponsitory)
    {
        $this->productRepository = $productResponsitory;
        $this->huntingResponsitory = $huntingResponsitory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featureNewArrivalProducts = $this->productRepository->getNewArrivalProducts(8);
        $newHuntingProducts = $this->huntingResponsitory->getNewHuntingProducts(4);
        $newSwappingProducts = $this->productRepository->getNewSwappingProducts(8);
        return view('front.index.index', compact('featureNewArrivalProducts', 'newHuntingProducts', 'newSwappingProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
