<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $table = 'product_variations';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'price',
        'sale_price',
        'status',
        'feature_image',
        'sku'
    ];

    public function product(){
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    public function attributes() {
        return $this->belongsToMany('App\Models\Attribute', 'variation_attributes', 'product_variation_id','attribute_id');
    }

    public function variation() {
        return $this->belongsTo('App\Models\VariationAttribute', 'id', 'product_variation_id');
    }

    public function variations() {
        return $this->hasMany('App\Models\VariationAttribute', 'product_variation_id', 'id');
    }
}
