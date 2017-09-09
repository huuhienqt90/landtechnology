<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\UserMeta;

class UserMetaRepository extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\UserMeta';
    }

    public function getValueByKey($key = 'balance', $user_id = 0){
        if( $user_id && $this->findWhere(['key' =>$key, 'user_id' => $user_id])->count() ){
            return $this->findWhere(['key' =>$key, 'user_id' => $user_id])->first()->value;
        }else{
            return null;
        }
    }
}
