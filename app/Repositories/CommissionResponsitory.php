<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\Commissions;

class CommissionResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\Commissions';
    }

    public function getCommission($pro_type = 'seller', $category = 0){
    	return Commissions::where('category_id', $category)->where('product_type', $pro_type)->first();
    }
}