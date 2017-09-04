<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\User;

class UserResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\User';
    }

    public function insertGetID($arr = []) {
        if( !empty($arr) ) {
            return User::insertGetId($arr);
        }
        return null;
    }
}
