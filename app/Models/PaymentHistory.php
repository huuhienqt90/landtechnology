<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $table = 'payment_histories';

    public $timestamps = true;

    protected $fillable = [
        'seller_id',
        'order_id',
        'customer',
        'original_price',
        'price_after_fee',
        'price_fee',
        'note'
    ];

    /**
     * [user description]
     * @return [type] [description]
     */
    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'seller_id');
    }

    /**
     * [user description]
     * @return [type] [description]
     */
    public function order() {
        return $this->hasOne('App\Models\Order', 'id', 'order_id');
    }
}
