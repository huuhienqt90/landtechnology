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
}
