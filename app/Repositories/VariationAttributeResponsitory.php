<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\VariationAttribute;

class VariationAttributeResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\VariationAttribute';
    }

    public function deleteByProductVariationId($id) {
    	return VariationAttribute::where('product_variation_id', $id)->delete();
    }
}
