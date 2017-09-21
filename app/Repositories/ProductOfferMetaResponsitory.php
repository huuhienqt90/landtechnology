<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\ProductOfferMeta;

class ProductOfferMetaResponsitory extends Repository {
    protected $model;

    public function model() {
        return 'App\Models\ProductOfferMeta';
    }

    /**
     * [deleteProductOfferMetaById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteProductOfferMetaById($id) {
    	return ProductOfferMeta::where('product_offer_id', $id)->delete();
    }
}
