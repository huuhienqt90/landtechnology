<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\Setting;

class SettingRepository extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\Setting';
    }

    public function getValueByKey($key = 'admin_paypal'){
        if( $this->findWhere(['key' =>$key])->count() ){
            return $this->findWhere(['key' =>$key])->first()->value;
        }else{
            return null;
        }
    }
}
