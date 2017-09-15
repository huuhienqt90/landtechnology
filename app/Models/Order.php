<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public $timestamps = true;

    protected $fillable = [
        'status',
        'customer',
        'tax',
        'subtotal',
        'total',
        'customer_note'
    ];

    public function products(){
        return $this->hasMany('App\Models\OrderProduct', 'product_id', 'id');
    }

    public function user_metas(){
        return $this->hasMany('App\Models\OrderMeta', 'order_id', 'id');
    }
}
