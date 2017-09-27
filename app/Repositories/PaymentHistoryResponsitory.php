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

    public function getCostCommission($cate, $price = 0, $product_type = 'seller') {
        $commission = Commissions::where('category_id', $cate)->where('product_type', $product_type);
        if( $commission != null && $commission->count() ){
            if( $commission->first()->type == 'percent' ) {
                $fee = ($price * $commission->cost) / 100;
                if( $fee > $commission->maximum ) {
                    $fee = $commission->maximum;
                }
            }else{
                $fee = $commission->cost;
            }
        }else{
            $fee = 0;
        }
    	return $fee;
    }
}
