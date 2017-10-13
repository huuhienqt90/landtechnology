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

    public function deleteByProductID($id) {
    	return ProductVariation::where('product_id', $id)->delete();
    }
}
