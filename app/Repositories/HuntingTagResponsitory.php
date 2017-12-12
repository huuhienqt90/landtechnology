<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\HuntingTag;

class HuntingTagResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\HuntingTag';
    }

    public function deleteByProductId($id) {
        return HuntingTag::where('hunting_id', $id)->delete();
    }
}
