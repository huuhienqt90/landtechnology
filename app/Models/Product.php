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
        'start_date',
        'end_date',
        'seller_id',
        'feature_image',
        'description_short',
        'description',
        'product_brand',
        'key_words',
        'sell_type_id',
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

    /**
     * Get product brands
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand(){
        return $this->hasOne('App\Models\Brand', 'id', 'product_brand');
    }

    /**
     * Get sell type product
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sellType(){
        return $this->hasOne('App\Models\SellType', 'id','sell_type_id');
    }

    /**
     * Get seller
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seller(){
        return $this->hasOne('App\Models\User', 'id', 'seller_id');
    }

    /**
     * Belong to categories
     *
     * @return [type] [description]
     */
    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'product_categories', 'product_id', 'category_id');
    }

    /**
     * Get product images
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(){
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id');
    }

    /**
     * Product reviews
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews(){
        return $this->hasMany('App\Models\ProductReview', 'product_id', 'id');
    }

    /**
     * Product attributes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes(){
        return $this->hasMany('App\Models\ProductAttribute', 'product_id', 'id');
    }

    /**
     * Get feature image
     * @param int $productId
     * @return string
     */
    public static function getFeatureImage($productId = 0){
        $product = static::find($productId);
        if( isset( $product->feature_image ) && !empty( $product->feature_image ) ){
            return asset('storage/'.$product->feature_image);
        }else{
            return asset('assets/images/img-hv-cart.png');
        }
    }

    /**
     * Get price
     *
     * @return mixed
     */
    public function getPrice(){
        if( $this->sale_price > 0 && $this->original_price > $this->sale_price){
            return '<span class="tx-sp-line-through">$'.number_format($this->original_price, 2).'</span> <span class="product-price tx-sp-cl">$'.number_format($this->sale_price, 2). '</span>';
        }else{
            return '<span class="product-price tx-sp-cl">$'.number_format($this->original_price, 2). '</span>';
        }
    }

    /**
     * Get Price as number value
     *
     * @return mixed
     */
    public function getPriceNumber(){
        if( $this->sale_price > 0 && $this->original_price > $this->sale_price){
            return $this->sale_price;
        }else{
            return $this->original_price;
        }
    }
}
