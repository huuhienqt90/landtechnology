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

    /**
     * Get feature products
     */
    public function getFeatureProducts($take = 4){
        return Product::active()->paginate($take);
    }

    /**
     * Get feature products
     */
    public function getNewArrivalProducts($take = 4){
        return Product::active()->where('kind', 'selling')->paginate($take);
    }

    /**
     * Get new hunting products
     */
    public function getNewHuntingProducts($take = 4){
        return Product::active()->where('kind', 'hunting')->paginate($take);
    }

    /**
     * Get new swapping products
     */
    public function getNewSwappingProducts($take = 4){
        return Product::active()->where('kind', 'swapping')->paginate($take);
    }

    /**
     * Get product by name
     */
    public function getProductByName($name)
    {
        return Product::active()->where('name', 'like', '%' . $name . '%')->get();
    }

    /**
     * Get active products by category slug
     */
    public function getProductsByCategory($slug, $take = 12){
        return Product::active()->whereHas('categories', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->paginate($take);
    }

    /**
     * Get active products by brand slug
     */
    public function getProductsByBrand($slug, $take = 12){
        return Product::active()->whereHas('brand', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->paginate($take);
    }

    /**
     * Get active selling products
     */
    public function getSellingProducts($userId, $take = 12){
        return Product::where('seller_id', $userId)->where('kind', 'selling')->paginate($take);
    }

    /**
     * Get active hunting products
     */
    public function getHuntingProducts($userId, $take = 12){
        return Product::where('seller_id', $userId)->where('kind', 'hunting')->paginate($take);
    }

    /**
     * Get active swaping products
     */
    public function getSwapingProducts($userId, $take = 12){
        return Product::active()->where('seller_id', $userId)->where('kind', 'swapping')->paginate($take);
    }
}
