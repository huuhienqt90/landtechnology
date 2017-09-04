<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryResponsitory;
use App\Repositories\SellerShippingResponsitory;
use App\Repositories\SellTypeResponsitory;
use App\Repositories\BrandResponsitory;
use App\Repositories\ProductResponsitory;
use App\Repositories\UserResponsitory;
use App\Repositories\ProductCategoryResponsitory;
use App\Repositories\ProductImageResponsitory;
use App\Http\Requests\SellerRequest;
use Auth;

class SellerController extends Controller
{
    protected $categoryResponsitory;
    protected $brandResponsitory;
    protected $sellerShippingResponsitory;
    protected $sellTypeResponsitory;
    protected $productResponsitory;
    protected $userResponsitory;
    protected $productCategoryResponsitory;
    protected $productImageResponsitory;

    public function __construct(CategoryResponsitory $categoryResponsitory,
                                BrandResponsitory $brandResponsitory,
                                SellerShippingResponsitory $sellerShippingResponsitory, 
                                SellTypeResponsitory $sellTypeResponsitory, 
                                ProductResponsitory $productResponsitory, 
                                UserResponsitory $userResponsitory, 
                                ProductCategoryResponsitory $productCategoryResponsitory, 
                                ProductImageResponsitory $productImageResponsitory)
    {
        $this->categoryResponsitory         = $categoryResponsitory;
        $this->brandResponsitory            = $brandResponsitory;
        $this->sellerShippingResponsitory   = $sellerShippingResponsitory;
        $this->sellTypeResponsitory         = $sellTypeResponsitory;
        $this->productResponsitory          = $productResponsitory;
        $this->userResponsitory             = $userResponsitory;
        $this->productCategoryResponsitory  = $productCategoryResponsitory;
        $this->productImageResponsitory     = $productImageResponsitory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('front.seller.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = $this->brandResponsitory->getArrayNameBrands();
        $categories = $this->categoryResponsitory->getArrayNameCategories();
        $selltypes = $this->sellTypeResponsitory->getArrayNameSellTypes();
        return view('front.seller.create', compact('brands','categories','selltypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellerRequest $request)
    {
        $param = $request->only(['name','slug','original_price','discount','price_after_discount','sale_price','display_price','description','product_brand','key_words','sell_type_id','weight','location','stock','sold_units']);
        $param['seller_id'] = Auth::user()->id;
        $param['status'] = 'Pending';
        $param['created_by'] = Auth::user()->id;
        if( $request->hasFile('feature_image') ){
            $path = $request->file('feature_image')->store('sellproduct');
            $param['feature_image'] = $path;
        }

        $result = $this->productResponsitory->create($param);

        if( isset( $request->category ) ){
            foreach($request->category as $cat){
                $this->productCategoryResponsitory->create(['product_id' => $result->id, 'category_id' => $cat]);
            }
        }
        // Create Product Images
        if( $request->hasFile('product_images') ){
            $productImages = $request->file('product_images');
            foreach ($productImages as $file) {
                $path = $file->store('sellproduct/galeries');
                $this->productImageResponsitory->create(['product_id' => $result->id, 'image_path' => $path, 'image_name'=> $file->getClientOriginalName()]);
            }
        }

        return redirect(route('front.dashboard.index'))->with('msgOk', 'Create product success!');
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
