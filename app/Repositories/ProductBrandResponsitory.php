<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\ProductBrand;

class ProductBrandResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\ProductBrand';
    }
}
