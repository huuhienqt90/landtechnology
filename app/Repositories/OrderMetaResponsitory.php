<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\OrderMeta;

class OrderMetaResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\OrderMeta';
    }

    public function deleteOrderMeta($id) {
    	return OrderMeta::where('order_id', $id)->delete();
    }
}