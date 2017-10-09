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
use App\Repositories\ProductAttributeResponsitory;
use App\Repositories\ProductImageResponsitory;
use App\Repositories\AttributeResponsitory;
use App\Repositories\AttributeGroupResponsitory;
use App\Repositories\ProductMetaResponsitory;
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
    protected $productAttributeResponsitory;
    protected $productMetaResponsitory;

    public function __construct(CategoryResponsitory $categoryResponsitory, BrandResponsitory $brandResponsitory, SellerShippingResponsitory $sellerShippingResponsitory, SellTypeResponsitory $sellTypeResponsitory, ProductResponsitory $productResponsitory, UserResponsitory $userResponsitory, ProductCategoryResponsitory $productCategoryResponsitory, ProductImageResponsitory $productImageResponsitory, AttributeResponsitory $attributeResponsitory, AttributeGroupResponsitory $attributeGroupResponsitory, ProductAttributeResponsitory $productAttributeResponsitory, ProductMetaResponsitory $productMetaResponsitory){
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
        $this->productAttributeResponsitory = $productAttributeResponsitory;
        $this->productMetaResponsitory      = $productMetaResponsitory;
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
        $categories = $this->categoryResponsitory->findAllBy('parent_id', 0);
        $cateArr = [];
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

        $shippings = $this->sellerShippingResponsitory->findWhere(['seller_id' => auth()->user()->id]);
        return view('dashboard::product.create', compact('categories','product', 'cateArr', 'brandArr', 'sellerArr', 'sellTypeArr','attrArr','shippings'));
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
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'product_type' => $request->product_type,
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price,
            'seller_id' => auth()->user()->id,
            'kind' => 'selling',
            'description_short' => $request->description_short,
            'description' => $request->description,
            'key_words' => $request->key_words,
            'sell_type_id' => $request->sell_type,
            'sold_units' => 0
        ];

        if( $request->stock == null ) {
            $create['stock'] = 0;
        }else{
            $create['stock'] = $request->stock;
        }

        if( $request->hasFile('feature_image') ){
            $path = $request->file('feature_image')->store('products/features');
            $create['feature_image'] = $path;
        }
        $result = $this->productResponsitory->create($create);

        // Create category product
        if( $request->categories != null ) {
            foreach($request->categories as $category) {
                $this->productCategoryResponsitory->create(['product_id' => $result->id, 'category_id' => $category]);
            }
        }
        // Create Product Images
        if( $request->hasFile('product_images') ){
            $productImages = $request->file('product_images');
            foreach ($productImages as $file) {
                $path = $file->store('products/galeries');
                $this->productImageResponsitory->create(['product_id' => $result->id, 'image_path' => $path, 'image_name'=> $file->getClientOriginalName()]);
            }
        }

        // Create Product Meta
        if( $request->sku != null ) {
            $this->productMetaResponsitory->create(['product_id' => $result->id, 'key' => 'sku', 'value' => $request->sku]);
        }

        if( $request->stock_status != null ) {
            $this->productMetaResponsitory->create(['product_id' => $result->id, 'key' => 'stockStatus', 'value' => $request->stock_status]);
        }

        if( $request->input('arrAttributes') != null ){
            $paramAttrs = $request->input('arrAttributes');
            foreach($paramAttrs as $key => $paramAttr){
                foreach($paramAttr as $item){
                    $this->productAttributeResponsitory->create(['product_id' => $result->id, 'attribute_id' => $key, 'value' => $item]);
                }
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
        $categories = $this->categoryResponsitory->findAllBy('parent_id', 0);
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

        $productAttributes = $this->productAttributeResponsitory->findAllBy('product_id', $id);
        $productAttributesArr = [];
        $attributesArr = [];
        $listAttrs = [];
        if( $productAttributes && $productAttributes->count() ){
            foreach( $productAttributes as $productAttribute ){
                $productAttributesArr[$productAttribute->attribute_id] = $productAttribute->attribute->name;
                $attributesArr[$productAttribute->id] = $productAttribute->value;
            }
        }

        $product->attribute = $productAttributesArr;

        $attrs = $this->attributeResponsitory->all();
        $attrArr = [];
        foreach($attrs as $attr){
            $attrArr[$attr->id] = $attr->name;
        }

        $product->product_images = $productImageArr;
        $shippings = $this->sellerShippingResponsitory->findWhere(['seller_id' => auth()->user()->id]);

        return view('dashboard::product.edit', compact('categories','product', 'cateArr', 'brandArr', 'sellerArr', 'sellTypeArr','attrArr','attributesArr','listAttrs','productImages','shippings'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = $this->productResponsitory->find($id);
        $update = [
            'status' => $request->status,
            'name' => $request->name,
            'product_type' => $request->product_type,
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price,
            'seller_id' => auth()->user()->id,
            'kind' => 'selling',
            'description_short' => $request->description_short,
            'description' => $request->description,
            'product_brand' => $request->product_brand,
            'key_words' => $request->key_words,
            'sell_type_id' => $request->sell_type,
            'sold_units' => 0
        ];

        if( $request->stock == null ) {
            $update['stock'] = 0;
        }else{
            $update['stock'] = $request->stock;
        }

        // Update feature image
        if( $request->hasFile('feature_image') ){
            $path = $request->file('feature_image')->store('products/features');
            $update['feature_image'] = $path;
        }
        if( $product->slug != str_slug($request->name) ) {
            $update['slug'] = str_slug($request->name);
        }
        $this->productResponsitory->update($update, $id);

        // Update product category
        $this->productCategoryResponsitory->deleteProductCategory($id);
        if( $request->categories != null ) {
            foreach($request->categories as $category) {
                $this->productCategoryResponsitory->create(['product_id' =>$id, 'category_id' => $category]);
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

        // Create Product Meta
        if( $request->sku != null ) {
            $this->productMetaResponsitory->deleteProductMeta($id, 'sku');
            $this->productMetaResponsitory->create(['product_id' => $id, 'key' => 'sku', 'value' => $request->sku]);
        }

        if( $request->stock_status != null ) {
            $this->productMetaResponsitory->deleteProductMeta($id, 'stockStatus');
            $this->productMetaResponsitory->create(['product_id' => $id, 'key' => 'stockStatus', 'value' => $request->stock_status]);
        }

        if( $request->input('arrAttributes') != null ){
            $paramAttrs = $request->input('arrAttributes');
            $this->productAttributeResponsitory->deleteProductAttribute($id);
            foreach($paramAttrs as $key => $paramAttr){
                foreach($paramAttr as $item){
                    $this->productAttributeResponsitory->create(['product_id' => $id, 'attribute_id' => $key, 'value' => $item]);
                }
            }
        }else{
            $this->productAttributeResponsitory->deleteProductAttribute($id);
        }
        return redirect(route('dashboard.product.index'))->with('alert-success', 'Update product success!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $product_images = $this->productImageResponsitory->findAllBy('product_id', $id);
        if($product_images != null) {
            foreach($product_images as $image){
                \Storage::delete($image->image_path);
                $this->productImageResponsitory->delete($id);
            }
        }
        $product = $this->productResponsitory->find($id);
        \Storage::delete($product->feature_image);
        $this->productResponsitory->delete($id);
        return redirect(route('dashboard.product.index'))->with('alert-success', 'Delete product success!');
    }

    public function getAttribute(Request $request){
        if( $request->ajax() ){
            $id = $request->id;
            if( !empty($id) ){
                $data = $this->attributeResponsitory->find($id);
                return response()->json($data);
            }
            return null;
        }
    }

    public function addFastAttribute(Request $request){
        if( $request->ajax() ){
            $id = $request->id;
            $val = $request->val;
            if( $id != null ){
                $data = $this->attributeResponsitory->find($id);
                $options = explode(',', $data->options);
                $options[] = $val;
                $options = implode(',',$options);
                $param['options'] = $options;
                $kq = $this->attributeResponsitory->update($param, $id);
                return $kq;
            }
            return false;
        }
    }

    /**
     * [deleteImageByAjax Delete image in table product]
     * @param  [type] $id [description]
     * @return boolean
     */
    public function deleteImageByAjax($id){
        $arItem = $this->productResponsitory->find($id);
        \Storage::delete($arItem->feature_image);
        $param['feature_image'] = null;
        $this->productResponsitory->update($param, $id);
        return ['success' => true];
    }

    /**
     * [deleteImageByAjax Delete image in table product image]
     * @param  [type] $id [description]
     * @return boolean
     */
    public function deleteProductImageByAjax($id){
        $arItem = $this->productImageResponsitory->find($id);
        \Storage::delete($arItem->image_path);
        $this->productImageResponsitory->delete($id);
        return ['success' => true];
    }

    /**
     * [getProductByName description]
     * @param  Request $request [description]
     * @return [json]           [description]
     */
    public function getProductByName(Request $request)
    {
        if($request->ajax()){

            $name = trim($request->q);

            if (empty($name)) {
                return response()->json([]);
            }

            $names = $this->productResponsitory->getProductByName($name);

            $productArr = [];

            foreach($names as $item){
                $res = new \stdClass;
                $res->id = $item->id;
                $res->text = $item->name;
                $productArr[] = $res;
            }

            return response()->json($productArr);
        }
    }

    public function getProductById(Request $request)
    {
        if($request->ajax()){

            $id = trim($request->id);

            if (empty($id)) {
                return response()->json([]);
            }

            $product = $this->productResponsitory->find($id);

            $price = 0;

            if($product->sale_price > 0){
                $price = $product->sale_price;
            }else{
                $price = $product->original_price;
            }

            return response()->json($price);
        }
    }
}
