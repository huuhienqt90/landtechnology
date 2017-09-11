<?php
use App\Models\Brand;
use App\Models\Product;
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
		'hunting' => 'Hunting', 
		'seller' => 'Seller', 
		'swap' => 'Swap'
	];
}

function setActiveProduct(){
	return $array = [
		'active' => 'Active', 
		'pending' => 'Pending', 
		'need-confirm' => 'Need confirm'
	];
}