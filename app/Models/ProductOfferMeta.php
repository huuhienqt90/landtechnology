<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOfferMeta extends Model
{
    protected $table = 'product_offer_metas';

    public $timestamps = true;

    protected $fillable = [
        'product_offer_id',
        'key',
        'value'
    ];

    public function product_offer(){
        return $this->hasOne('App\Models\Hunting', 'id', 'product_offer_id');
    }
}
