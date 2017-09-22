<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\PaymentHistory;
use App\Models\Commissions;

class PaymentHistoryResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\PaymentHistory';
    }

    public function getCostCommission($cate, $product_type = 'seller') {
    	return Commissions::where('category_id', $cate)->where('product_type', $product_type)->first();
    }
}