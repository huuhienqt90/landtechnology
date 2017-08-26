<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table = 'product_attributes';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'seller_id',
        'attribute_id',
        'value'
    ];
}
