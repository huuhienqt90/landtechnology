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

    public function getProductByName($name)
    {
        return Product::where('name', 'like', '%' . $name . '%')->where('status', 'active')->get();
    }

    public function getProductsByCategory($slug, $take = 12){
        return Product::where('status', 'active')->whereHas('categories', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->paginate($take);
    }

    public function getProductsByBrand($slug, $take = 12){
        return Product::where('status', 'active')->whereHas('brand', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->paginate($take);
    }
}
