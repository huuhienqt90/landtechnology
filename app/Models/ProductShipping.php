<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductShipping extends Model
{
    protected $table = 'product_shippings';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'shipping_id',
        'note'
    ];
}
