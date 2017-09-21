<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HuntingImage;

class ProductOffer extends Model
{
    protected $table = 'product_offers';

    public $timestamps = true;

    protected $fillable = [
        'hunting_id',
        'user_id',
        'offer_price',
        'comment',
        'status'
    ];

    public function hunting(){
        return $this->hasOne('App\Models\Hunting', 'id', 'hunting_id');
    }

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function metas() {
        return $this->hasMany('App\Models\ProductOfferMeta', 'product_offer_id', 'id');
    }

    public function getImages() {
        return HuntingImage::where('product_offers_id', $this->id)->get();
    }

    public function isBuyer($id) {
        if( $id == $this->user_id ) {
            return true;
        }
        return false;
    }
}
