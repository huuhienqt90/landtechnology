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
use App\Repositories\AttributeResponsitory;
use App\Repositories\ProductCategoryResponsitory;
use App\Repositories\ProductImageResponsitory;
use App\Repositories\ProductAttributeResponsitory;
use App\Http\Requests\HuntingStoreRequest;
use App\Http\Requests\HuntingUpdateRequest;

class HuntingController extends Controller
{
    protected $categoryResponsitory;
    protected $brandResponsitory;
    protected $sellerShippingResponsitory;
    protected $sellTypeResponsitory;
    protected $productResponsitory;
    protected $userResponsitory;
    protected $productCategoryResponsitory;
    protected $productImageResponsitory;
    protected $productAttributeResponsitory;
    public function __construct(CategoryResponsitory $categoryResponsitory,
                                BrandResponsitory $brandResponsitory,
                                SellerShippingResponsitory $sellerShippingResponsitory,
                                SellTypeResponsitory $sellTypeResponsitory,
                                ProductResponsitory $productResponsitory,
                                UserResponsitory $userResponsitory,
                                ProductCategoryResponsitory $productCategoryResponsitory,
                                ProductImageResponsitory $productImageResponsitory,
                                AttributeResponsitory $attributeResponsitory,
                                ProductAttributeResponsitory $productAttributeResponsitory)
    {
        $this->categoryResponsitory         = $categoryResponsitory;
        $this->brandResponsitory            = $brandResponsitory;
        $this->sellerShippingResponsitory   = $sellerShippingResponsitory;
        $this->sellTypeResponsitory         = $sellTypeResponsitory;
        $this->productResponsitory          = $productResponsitory;
        $this->userResponsitory             = $userResponsitory;
        $this->productCategoryResponsitory  = $productCategoryResponsitory;
        $this->productImageResponsitory     = $productImageResponsitory;
        $this->attributeResponsitory        = $attributeResponsitory;
        $this->productAttributeResponsitory = $productAttributeResponsitory;
        $this->middleware('check.auth:seller');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productResponsitory->getHuntingProducts(auth()->user()->id);
        return view('front.hunting.index', compact('products'));
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
        $allCategories = $this->categoryResponsitory->all();
        $selltypes = $this->sellTypeResponsitory->getArrayNameSellTypes();

        $attrs = $this->attributeResponsitory->all();
        $attrArr = [];
        foreach($attrs as $attr){
            $attrArr[$attr->id] = $attr->name;
        }
        return view('front.hunting.create', compact('brands','categories','selltypes','allCategories','attrArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HuntingStoreRequest $request)
    {
        $param = $request->only(['name','slug','original_price','sale_price','description','description_short','product_brand','key_words','sell_type_id','weight','location','stock']);
        $param['sold_units'] = 0;
        $param['seller_id'] = auth()->user()->id;
        $param['status'] = 'Pending';
        $param['created_by'] = auth()->user()->id;
        $param['kind'] = 'hunting';
        if( $request->hasFile('feature_image') ){
            $path = $request->file('feature_image')->store('sellproduct');
            $param['feature_image'] = $path;
        }

        $result = $this->productResponsitory->create($param);

        // Create category product
        $this->productCategoryResponsitory->create(['product_id' => $result->id, 'category_id' => $request->category]);

        // Create Product Images
        if( $request->hasFile('product_images') ){
            $productImages = $request->file('product_images');
            foreach ($productImages as $file) {
                $path = $file->store('sellproduct/galeries');
                $this->productImageResponsitory->create(['product_id' => $result->id, 'image_path' => $path, 'image_name'=> $file->getClientOriginalName()]);
            }
        }
        return redirect(route('hunting.index'))->with('alert-success', 'Create hunting product success!');
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
        $product = $this->productResponsitory->find($id);
        $brands = $this->brandResponsitory->getArrayNameBrands();

        $categories = $this->categoryResponsitory->all();
        $cateArr = [];
        if( $categories && $categories->count() ){
            foreach ($categories as $cat) {
                $cateArr[$cat->id] = $cat->name;
            }
        }

        $selltypes = $this->sellTypeResponsitory->getArrayNameSellTypes();

        $productImages = $this->productImageResponsitory->findAllBy('product_id', $id);
        $productImageArr = [];
        if( $productImages && $productImages->count() ){
            foreach ($productImages as $productImage) {
                $productImageArr[$productImage->id] = $productImage->image_path;
            }
        }

        $productAttributesArr = [];
        $attributesArr = [];
        $productAttributes = $this->productAttributeResponsitory->findAllBy('product_id', $id);
        if( $productAttributes && $productAttributes->count() ){
            foreach( $productAttributes as $productAttribute ){
                $productAttributesArr[$productAttribute->attribute_id] = $productAttribute->attribute->name;
                $attributesArr[$productAttribute->id] = $productAttribute->value;
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

        $attrs = $this->attributeResponsitory->all();
        $attrArr = $this->attributeResponsitory->all();

        $product->attribute = $productAttributesArr;

        return view('front.hunting.edit', compact('product','brands','categories','selltypes','productImages','attrArr','attributesArr','cateArr'));
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
        $update = [
            'status' => 'Pending',
            'slug' => $request->slug,
            'name' => $request->name,
            'original_price' => $request->original_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'description_short' => $request->description_short,
            'description' => $request->description,
            'key_words' => $request->key_words,
            'weight' => $request->weight,
            'location' => $request->location,
            'seller_id' => Auth::user()->id,
            'sell_type_id' => $request->sell_type_id,
            'product_brand' => $request->product_brand
        ];

        // Update feature image
        if( $request->hasFile('feature_image') ){
            $path = $request->file('feature_image')->store('products/features');
            $update['feature_image'] = $path;
        }
        $this->productResponsitory->update($update, $id);

        // Update product category
        $this->productCategoryResponsitory->deleteProductCategory($id);
        $this->productCategoryResponsitory->create(['product_id' => $id, 'category_id' => $request->category]);

        // Update product images
        if( $request->hasFile('product_images') ){
            $productImages = $request->file('product_images');
            foreach ($productImages as $file) {
                $path = $file->store('products/galeries');
                $this->productImageResponsitory->create(['product_id' => $id, 'image_path' => $path, 'image_name'=>$file->getClientOriginalName()]);
            }
        }
        return redirect(route('hunting.index'))->with('alert-success', 'Update product success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_images = $this->productImageResponsitory->findAllBy('product_id', $id);
        if($product_images != null) {
            foreach($product_images as $image){
                \Storage::delete($image->image_path);
                $this->productImageResponsitory->delete($id);
            }
        }
        $this->productAttributeResponsitory->deleteProductAttribute($id);
        $product = $this->productResponsitory->find($id);
        \Storage::delete($product->feature_image);
        $this->productResponsitory->delete($id);
        return redirect(route('hunting.index'))->with('alert-success', 'Delete product success!');
    }
}
