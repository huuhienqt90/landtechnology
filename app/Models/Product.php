<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'product_type',
        'original_price',
        'sale_price',
        'display_price',
        'start_date',
        'end_date',
        'seller_id',
        'feature_image',
        'description',
        'product_brand',
        'key_words',
        'sell_type_id',
        'discount',
        'price_after_discount',
        'status',
        'weight',
        'location',
        'stock',
        'sold_units',
        'created_by',
        'updated_by'
    ];
}
