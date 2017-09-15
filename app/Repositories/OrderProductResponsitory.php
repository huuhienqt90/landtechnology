<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\OrderProduct;

class OrderProductResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\OrderProduct';
    }

    public function deleteOrderProduct($id){
    	return OrderProduct::where('order_id', $id)->delete();
    }
}