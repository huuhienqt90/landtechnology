<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\ProductVariation;

class ProductVariationResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\ProductVariation';
    }

    /**
     * Delete all variations by product id
     * @author Tong
     */
    public function deleteByProductID($id) {
    	return ProductVariation::where('product_id', $id)->delete();
    }

    /**
     * Delete variations by product id and not in ids
     * @author Hien
     */
    public function deleteProductVariation($id, $arrs = []){
        return ProductVariation::where('product_id', $id)->whereNotIn('id', $arrs)->delete();
    }

    public function getProductAttribute($id, $attrs){
        $prdt = 0;
        $productVariationData = null;
        foreach ($attrs as $key => $value) {
            $productVariation = ProductVariation::where('product_id', $id)->whereHas('attributes', function($query) use($key, $value){
                $query->where('attribute_id', $key)->where('value', $value);
            })->first();
            if( isset($productVariation->id) && ($prdt == 0 || $prdt == $productVariation->id) ){
                $prdt = $productVariation->id;
                $productVariationData = $productVariation->toArray();
            }else{
                $prdt = 0;
                $productVariationData = null;
            }
        }

        return ['id' => $prdt, 'data' => $productVariationData];
    }
}
