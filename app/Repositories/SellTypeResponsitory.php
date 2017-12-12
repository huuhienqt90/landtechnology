<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\SellType;

class SellTypeResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\SellType';
    }

    public function getArrayNameSellTypes(){
    	$sellTypes = SellType::all();
        $sellTypeArr = ['' => 'Select a sell type'];
        if( $sellTypes && $sellTypes->count() ){
            foreach ($sellTypes as $sellType) {
                $sellTypeArr[$sellType->id] = $sellType->name;
            }
        }
        return $sellTypeArr;
    }

    public function getSellTypesByUser($user_id, $take = 20)
    {
        $attrs = SellType::whereHas('author', function($query){
            $query->where('is_admin', 1);
        })->orWhere('created_by', $user_id)->paginate($take);
        return $attrs;
    }
}
