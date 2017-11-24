<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\ProductBooking;

class ProductBookingResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\ProductBooking';
    }
}
