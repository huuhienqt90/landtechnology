<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\Product;

class ProductResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\Product';
    }

    public function getFeatureProducts($take = 4){
        return Product::where('status', 'active')->take($take)->get();
    }
}
