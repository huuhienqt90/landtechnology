<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $table = 'product_brands';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'brand_id'
    ];
}
