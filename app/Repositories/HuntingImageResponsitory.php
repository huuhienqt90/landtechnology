<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\HuntingImage;

class HuntingImageResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\HuntingImage';
    }
}