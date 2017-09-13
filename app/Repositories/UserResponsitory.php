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

    public function getUserByName($name) {
        return User::where('confirmed',1)->where(function ($query) use ($name) {
            $query->where('first_name','like','%'.$name.'%')->orWhere('last_name','like','%'.$name.'%');
        })->get();
    }
}
