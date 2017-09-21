<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\Hunting;

class HuntingResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\Hunting';
    }

    /**
     * Get new hunting products
     */
    public function getNewHuntingProducts($take = 4){
        return Hunting::where('status', 'active')->paginate($take);
    }
}
