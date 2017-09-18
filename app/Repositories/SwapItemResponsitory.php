<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\SwapItem;

class SwapItemResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\SwapItem';
    }

    public function updateStatusItem($value, $product_id, $user_id, $created_by, $product_by) {
    	return SwapItem::where('product_id', $product_id)->where('user_id', $user_id)->where('created_by', $created_by)->where('product_by', $product_by)->update(['status' => $value]);
    }

    public function getListSwapAccept($user_id) {
    	return SwapItem::where('status','accept')->where(function ($query) use ($user_id) {
    		$query->orWhere('user_id', $user_id)->orWhere('created_by', $user_id);
    	})->get();
    }
}
