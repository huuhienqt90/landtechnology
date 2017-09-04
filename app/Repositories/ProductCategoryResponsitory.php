<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\ProductCategory;

class ProductCategoryResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\ProductCategory';
    }

    public function deleteProductCategory($prID){
        return ProductCategory::where('product_id', $prID)->delete();
    }
}
