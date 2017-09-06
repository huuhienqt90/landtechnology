<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\ProductAttribute;

class ProductAttributeResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\ProductAttribute';
    }

    public function deleteProductAttribute($id = 0){
    	if( $id ){
    		return ProductAttribute::where('product_id',$id)->delete();
    	}
    	return false;
    }
}
