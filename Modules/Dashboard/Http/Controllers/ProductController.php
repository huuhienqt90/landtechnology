<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\CategoryResponsitory;
use App\Repositories\SellerShippingResponsitory;
use App\Repositories\SellTypeResponsitory;
use App\Repositories\BrandResponsitory;
use App\Repositories\ProductResponsitory;
use App\Repositories\UserResponsitory;
use Modules\Dashboard\Http\Requests\ProductUpdateRequest;
use Modules\Dashboard\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    protected $categoryResponsitory;
    protected $brandResponsitory;
    protected $sellerShippingResponsitory;
    protected $sellTypeResponsitory;
    protected $productResponsitory;
    protected $userResponsitory;
    public function __construct(CategoryResponsitory $categoryResponsitory, BrandResponsitory $brandResponsitory, SellerShippingResponsitory $sellerShippingResponsitory, SellTypeResponsitory $sellTypeResponsitory, ProductResponsitory $productResponsitory, UserResponsitory $userResponsitory){
        $this->categoryResponsitory         = $categoryResponsitory;
        $this->brandResponsitory            = $brandResponsitory;
        $this->sellerShippingResponsitory   = $sellerShippingResponsitory;
        $this->sellTypeResponsitory         = $sellTypeResponsitory;
        $this->productResponsitory          = $productResponsitory;
        $this->userResponsitory             = $userResponsitory;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $products = $this->productResponsitory->all();
        return view('dashboard::product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $product = $this->productResponsitory;
        $categories = $this->categoryResponsitory->all();
        $cateArr = ['' => 'Select a category'];
        if( $categories && $categories->count() ){
            foreach ($categories as $cat) {
                $cateArr[$cat->id] = $cat->name;
            }
        }

        $brands = $this->brandResponsitory->all();
        $brandArr = ['' => 'Select a brand'];
        if( $brands && $brands->count() ){
            foreach ($brands as $brand) {
                $brandArr[$brand->id] = $brand->name;
            }
        }

        $sellers = $this->userResponsitory->all();
        $sellerArr = ['' => 'Select a seller'];
        if( $sellers && $sellers->count() ){
            foreach ($sellers as $seller) {
                $sellerArr[$seller->id] = $seller->getFullName();
            }
        }

        $sellTypes = $this->sellTypeResponsitory->all();
        $sellTypeArr = ['' => 'Select a seller'];
        if( $sellTypes && $sellTypes->count() ){
            foreach ($sellTypes as $sellType) {
                $sellTypeArr[$sellType->id] = $sellType->name;
            }
        }
        return view('dashboard::product.create', compact('product', 'cateArr', 'brandArr', 'sellerArr', 'sellTypeArr'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(ProductStoreRequest $request)
    {
        $create = [
            'status' => $request->status,
            'slug' => $request->slug,
            'name' => $request->name,
            'original_price' => $request->original_price,
            'display_price' => $request->display_price,
            'discount' => $request->discount,
            'price_after_discount' => $request->price_after_discount,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'sold_units' => $request->sold_units,
            'description' => $request->description,
            'key_words' => $request->status,
            'weight' => $request->weight,
            'location' => $request->location,
            'seller_id' => $request->seller_id,
            'sell_type_id' => $request->sell_type_id,
            'product_brand' => $request->product_brand,
        ];
        $this->productResponsitory->create($create);
        return redirect(route('dashboard.product.index'))->with('alert-success', 'Create product sucess!');
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
        $product = $this->productResponsitory->find($id);
        $categories = $this->categoryResponsitory->all();
        $cateArr = [];
        if( $categories && $categories->count() ){
            foreach ($categories as $cat) {
                $cateArr[$cat->id] = $cat->name;
            }
        }

        $brands = $this->brandResponsitory->all();
        $brandArr = [0 => 'Select a brand'];
        if( $brands && $brands->count() ){
            foreach ($brands as $brand) {
                $brandArr[$brand->id] = $brand->name;
            }
        }

        $sellers = $this->userResponsitory->all();
        $sellerArr = [0 => 'Select a seller'];
        if( $sellers && $sellers->count() ){
            foreach ($sellers as $seller) {
                $sellerArr[$seller->id] = $seller->getFullName();
            }
        }

        $sellTypes = $this->sellTypeResponsitory->all();
        $sellTypeArr = [0 => 'Select a seller'];
        if( $sellTypes && $sellTypes->count() ){
            foreach ($sellTypes as $sellType) {
                $sellTypeArr[$sellType->id] = $sellType->name;
            }
        }
        return view('dashboard::product.edit', compact('product', 'cateArr', 'brandArr', 'sellerArr', 'sellTypeArr'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(ProductUpdateRequest $request)
    {
        $update = [
            'status' => $request->status,
            'slug' => $request->slug,
            'name' => $request->name,
            'original_price' => $request->original_price,
            'display_price' => $request->display_price,
            'discount' => $request->discount,
            'price_after_discount' => $request->price_after_discount,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'sold_units' => $request->sold_units,
            'description' => $request->description,
            'key_words' => $request->status,
            'weight' => $request->weight,
            'location' => $request->location,
            'seller_id' => $request->seller_id,
            'sell_type_id' => $request->sell_type_id,
            'product_brand' => $request->product_brand,
        ];
        $this->productResponsitory->update($update, $id);
        return redirect(route('dashboard.product.index'))->with('alert-success', 'Update product sucess!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
