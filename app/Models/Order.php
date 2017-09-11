<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public $timestamps = true;

    protected $fillable = [
        'status',
        'user',
        'payment_method',
        'shipping_method',
        'tax',
        'subtotal',
        'total',
        'note'
    ];
}
