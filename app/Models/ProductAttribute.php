<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table = 'product_attributes';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'attribute_id',
        'value'
    ];

    public function product(){
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    public function group(){
        return $this->hasOne('App\Models\Attribute', 'id', 'attribute_id');
    }
}
