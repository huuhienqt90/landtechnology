<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;

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

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function brand(){
        return $this->hasOne('App\Models\Brand', 'id', 'product_brand');
    }

    public function sellType(){
        return $this->hasOne('App\Models\SellType', 'id','sell_type_id');
    }

    public function seller(){
        return $this->hasOne('App\Models\User', 'id', 'seller_id');
    }
}
