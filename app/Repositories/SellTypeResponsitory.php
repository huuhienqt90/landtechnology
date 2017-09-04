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
        $sellTypeArr = ['' => 'Select a seller'];
        if( $sellTypes && $sellTypes->count() ){
            foreach ($sellTypes as $sellType) {
                $sellTypeArr[$sellType->id] = $sellType->name;
            }
        }
        return $sellTypeArr;
    }
}
