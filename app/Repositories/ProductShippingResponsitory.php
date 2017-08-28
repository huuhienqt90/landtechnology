<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\ProductShipping;

class ProductShippingResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\ProductShipping';
    }
}
