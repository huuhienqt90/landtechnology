<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    protected $table = 'product_metas';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'key',
        'value'
    ];

    public function product(){
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    public function getValue($key) {
        $meta = static::where('product_id', $this->product_id)->where('key', $key)->first();
        if( isset($meta) && count($meta) > 0 ) {
            return $meta->value;
        }
        return null;
    }
}