<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\ProductTag;

class ProductTagResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\ProductTag';
    }

    public function deleteByProductId($id) {
        return ProductTag::where('product_id', $id)->delete();
    }
}
