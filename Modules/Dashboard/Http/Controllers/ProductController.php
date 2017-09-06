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
use App\Repositories\ProductCategoryResponsitory;
use App\Repositories\ProductImageResponsitory;
use App\Repositories\AttributeResponsitory;
use App\Repositories\AttributeGroupResponsitory;
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
    protected $productCategoryResponsitory;
    protected $productImageResponsitory;
    protected $attributeGroupResponsitory;

    public function __construct(CategoryResponsitory $categoryResponsitory, BrandResponsitory $brandResponsitory, SellerShippingResponsitory $sellerShippingResponsitory, SellTypeResponsitory $sellTypeResponsitory, ProductResponsitory $productResponsitory, UserResponsitory $userResponsitory, ProductCategoryResponsitory $productCategoryResponsitory, ProductImageResponsitory $productImageResponsitory, AttributeResponsitory $attributeResponsitory, AttributeGroupResponsitory $attributeGroupResponsitory){
        $this->categoryResponsitory         = $categoryResponsitory;
        $this->brandResponsitory            = $brandResponsitory;
        $this->sellerShippingResponsitory   = $sellerShippingResponsitory;
        $this->sellTypeResponsitory         = $sellTypeResponsitory;
        $this->productResponsitory          = $productResponsitory;
        $this->userResponsitory             = $userResponsitory;
        $this->productCategoryResponsitory  = $productCategoryResponsitory;
        $this->productImageResponsitory     = $productImageResponsitory;
        $this->attributeResponsitory        = $attributeResponsitory;
        $this->attributeGroupResponsitory   = $attributeGroupResponsitory;
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

        $attrs = $this->attributeResponsitory->all();
        $attrArr = [];
        foreach($attrs as $attr){
            $attrArr[$attr->id] = $attr->name;
        }

        $sellTypes = $this->sellTypeResponsitory->all();
        $sellTypeArr = ['' => 'Select a seller'];
        if( $sellTypes && $sellTypes->count() ){
            foreach ($sellTypes as $sellType) {
                $sellTypeArr[$sellType->id] = $sellType->name;
            }
        }
        return view('dashboard::product.create', compact('product', 'cateArr', 'brandArr', 'sellerArr', 'sellTypeArr','attrArr'));
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
        if( $request->hasFile('feature_image') ){
            $path = $request->file('feature_image')->store('products');
            $create['feature_image'] = $path;
        }
        $result = $this->productResponsitory->create($create);
        if( isset( $request->category ) ){
            foreach($request->category as $cat){
                $this->productCategoryResponsitory->create(['product_id' => $result->id, 'category_id' => $cat]);
            }
        }
        return redirect(route('dashboard.product.index'))->with('alert-success', 'Create product sucess!');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        // return view('dashboard::show');
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
        $productCategories = $this->productCategoryResponsitory->findAllBy('product_id', $id);
        $productCategoryArr = [];
        if( $productCategories && $productCategories->count() ){
            foreach ($productCategories as $productCategory) {
                $productCategoryArr[$productCategory->category_id] = $productCategory->category_id;
            }
        }
        $product->category = $productCategoryArr;

        $productImages = $this->productImageResponsitory->findAllBy('product_id', $id);
        $productImageArr = [];
        if( $productImages && $productImages->count() ){
            foreach ($productImages as $productImage) {
                $productImageArr[$productImage->id] = $productImage->image_path;
            }
        }

        $attrs = $this->attributeResponsitory->all();
        $attrArr = [];
        foreach($attrs as $attr){
            $attrArr[$attr->id] = $attr->name;
        }

        $product->product_images = $productImageArr;

        return view('dashboard::product.edit', compact('product', 'cateArr', 'brandArr', 'sellerArr', 'sellTypeArr','attrArr'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(ProductUpdateRequest $request, $id)
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

        // Update feature image
        if( $request->hasFile('feature_image') ){
            $path = $request->file('feature_image')->store('products/features');
            $update['feature_image'] = $path;
        }
        $this->productResponsitory->update($update, $id);

        // Update product category
        if( isset( $request->category ) ){
            $this->productCategoryResponsitory->deleteProductCategory($id);
            foreach($request->category as $cat){
                $this->productCategoryResponsitory->create(['product_id' => $id, 'category_id' => $cat]);
            }
        }

        // Update product images
        if( $request->hasFile('product_images') ){
            $productImages = $request->file('product_images');
            foreach ($productImages as $file) {
                $path = $file->store('products/galeries');
                $this->productImageResponsitory->create(['product_id' => $id, 'image_path' => $path, 'image_name'=>$file->getClientOriginalName()]);
            }
        }

        // Remove product images
        if( isset( $request->remove_product_images ) && count($request->remove_product_images)){
            foreach ($request->remove_product_images as $prID) {
                $this->productImageResponsitory->delete($prID);
            }
        }
        return redirect(route('dashboard.product.index'))->with('alert-success', 'Update product sucess!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function setType(Request $request){
        if( $request->ajax() ){
            $ids = $request->id;
            if( !empty($ids) ){
                foreach($ids as $key => $id){
                    $data[$key] = $this->attributeResponsitory->getTypeByID($id);
                }
                return response()->json($data);
            }
            return null;
        }
    }
}
