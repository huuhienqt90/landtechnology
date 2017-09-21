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
}