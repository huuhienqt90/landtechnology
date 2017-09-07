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

function getProductCountByBrand($brandId = 0 )
{
    if ($brandId) {
        return Product::where('product_brand', $brandId)->count();
    } else {
        return 0;
    }
}