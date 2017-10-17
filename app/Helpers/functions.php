<?php
use App\Models\Brand;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductAttribute;
/**
 * Show selected or not
 * @param $pr1
 * @param $pr2
 * @return null|string
 */
function selected($pr1, $pr2){
    $return = $pr1 == $pr2 ? ' selected' : null;
    return $return;
}

/**
 * [getProductCountByBrand description]
 * @param  integer $brandId [description]
 * @return [type]           [description]
 */
function getProductCountByBrand($brandId = 0 )
{
    if ($brandId) {
        return Product::where('product_brand', $brandId)->count();
    } else {
        return 0;
    }
}

/**
 * [setTypeCommission description]
 */
function setTypeCommission(){
    return $array = [
        'percent' => 'Percent',
        'fixed' => 'Fixed'
    ];
}

function setProductTypeCommission(){
    return $array = [
        'seller' => 'Seller'
    ];
}

function setActiveProduct(){
    return $array = [
        'active' => 'Active',
        'pending' => 'Pending',
        'need-confirm' => 'Need confirm'
    ];
}

function setPaymentMethod() {
    return $array = [
        'paypal' => 'PayPal',
        'stripe' => 'Stripe'
    ];
}

function setOrderStatus(){
    return $array = [
        'pending' => 'Pending payment',
        'processing' => 'Processing',
        'on-hold' => 'On hold',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled'
    ];
}

function setProductType() {
    return $array = [
        'simple' => 'Simple',
        'booking' => 'Booking'
    ];
}

function getProductAttr($productId, $column){
    $product = Product::find($productId);
    if( isset( $product ) && $product->{$column} ){
        return $product->{$column};
    }else{
        return null;
    }
}

/**
 * Get feature image
 * @param int $productId
 * @return string
 */
function getFeatureImage($productId = 0){
    $product = Product::find($productId);
    if( isset( $product->feature_image ) && !empty( $product->feature_image ) ){
        return asset('storage/'.$product->feature_image);
    }else{
        return asset('assets/images/img-hv-cart.png');
    }
}

function getAttrName($attrId = 0){
    if( $attrId ){
        $attr = Attribute::find($attrId);
        if( isset($attr->name) && !empty($attr->name) ){
            return $attr->name;
        }else{
            return null;
        }
    }else{
        return null;
    }
}

function getArrayValueAttr($str) {
    return explode(',', $str);
}

function getArrayValueById($id, $product_id) {
    $attrs = ProductAttribute::where('attribute_id', $id)->where('product_id', $product_id)->get();
    $array = [];
    foreach($attrs as $attr) {
        $array[$attr->id] = $attr->value;
    }
    return $array;

}
