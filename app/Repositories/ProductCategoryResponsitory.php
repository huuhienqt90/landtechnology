<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\ProductCategory;
use App\Models\ProductBrand;

class ProductCategoryResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\ProductCategory';
    }

    public function deleteProductCategory($prID){
        return ProductCategory::where('product_id', $prID)->delete();
    }

    public function deleteProductBrand($prID) {
    	return ProductBrand::where('product_id', $prID)->delete();
    }
}
