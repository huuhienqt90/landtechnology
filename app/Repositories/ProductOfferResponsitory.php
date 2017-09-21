<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\ProductOffer;

class ProductOfferResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\ProductOffer';
    }
}