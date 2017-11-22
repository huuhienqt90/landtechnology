<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\Attribute;

class AttributeResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\Attribute';
    }

    public function getArrOptions($id){
    	$attrs = Attribute::find($id)->options;
    	return explode(",", $attrs);
    }

    public function findAllByUsers($user_id, $take = 20)
    {
        $attrs = Attribute::whereHas('user', function($query){
            $query->where('is_admin', 1);
        })->orWhere('seller_id', $user_id)->paginate($take);
        return $attrs;
    }
}
