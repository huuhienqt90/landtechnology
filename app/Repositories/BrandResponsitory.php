<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\Brand;
use App\Models\Product;

class BrandResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\Brand';
    }

    /**
     * @return [array] [list name brands]
     */
    public function getArrayNameBrands(){
        $brands = Brand::all();
        $brandArr = ['' => 'Select a brand'];
        if( $brands && $brands->count() ){
            foreach ($brands as $brand) {
                $brandArr[$brand->id] = $brand->name;
            }
        }
        return $brandArr;
    }

    /**
     * Delete product by brand id
     */
    public function deleteProductsByBrandId($brandId = 0){
        if( $brandId ){
            Product::where('product_brand', $brandId)->delete();
            return true;
        }else{
            return false;
        }
    }
}
