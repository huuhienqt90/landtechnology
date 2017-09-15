<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';

    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'product_id',
        'variation_id',
        'price',
        'tax',
        'total',
        'qty'
    ];

    public function order(){
        return $this->hasOne('App\Models\Order', 'id', 'order_id');
    }

    public function product(){
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
