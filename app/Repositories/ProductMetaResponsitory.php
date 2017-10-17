<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\ProductMeta;

class ProductMetaResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\ProductMeta';
    }

    public function deleteProductMeta($id, $key) {
    	return ProductMeta::where('product_id', $id)->where('key', $key)->delete();
    }
}