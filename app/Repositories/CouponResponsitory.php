<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\Coupon;

class CouponResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\Coupon';
    }
}
