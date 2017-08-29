<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\Category;

class CategoryResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\Category';
    }

    public function findAllNotWhere($column, $value){
        return Category::where($column, '!=', $value)->get();
    }
}
