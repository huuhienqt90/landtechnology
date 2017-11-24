<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\SellerShipping;

class SellerShippingResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\SellerShipping';
    }

    public function getSellerShippingsByUser($user_id, $take = 20)
    {
        $attrs = SellerShipping::Where('seller_id', $user_id)->paginate($take);
        return $attrs;
    }
}
