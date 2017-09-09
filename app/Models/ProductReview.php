<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $table = 'product_reviews';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'message',
        'rating',
        'user_id',
        'status'
    ];

    /**
     * Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product(){
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    /**
     * User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
