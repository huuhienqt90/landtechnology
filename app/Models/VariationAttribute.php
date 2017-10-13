<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariationAttribute extends Model
{
	protected $table = 'variation_attributes';

    public $timestamps = true;

    protected $fillable = [
        'product_variation_id',
        'attribute_id',
        'value'
    ];

    public function product_variation(){
        return $this->hasOne('App\Models\ProductVariation', 'id', 'product_variation_id');
    }

    public function attribute(){
        return $this->hasOne('App\Models\Attribute', 'id', 'attribute_id');
    }
}
