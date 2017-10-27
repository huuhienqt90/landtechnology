<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use App\Models\ProductVariation;

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
        'key_words',
        'sell_type_id',
        'status',
        'weight',
        'location',
        'stock',
        'sold_units',
        'created_by',
        'updated_by',
        'kind'
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
     * Belong to brands
     *
     * @return [type] [description]
     */
    public function brands() {
        return $this->belongsToMany('App\Models\Brand', 'product_brands', 'product_id', 'brand_id');
    }

    /**
     * [category description]
     * @return [type] [description]
     */
    public function category() {
        return $this->belongsTo('App\Models\ProductCategory', 'id', 'product_id');
    }

    public function meta() {
        return $this->belongsTo('App\Models\ProductMeta', 'id', 'product_id');
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

    public function product_variations() {
        return $this->hasMany('App\Models\ProductVariation', 'product_id', 'id');
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
    public function getFeatureImage(){
        if( isset( $this->feature_image ) && !empty( $this->feature_image ) ){
            return asset('storage/'.$this->feature_image);
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
        if( $this->product_type == 'variable' ){
            return ProductVariation::where('product_id', $this->id)->max('price');
        }
        if( $this->sale_price > 0 && $this->original_price > $this->sale_price){
            return $this->sale_price;
        }else{
            return $this->original_price;
        }
    }

    /**
     * Scope active
     *
     */
    public function scopeActive($query) {
        return $query->whereStatus('active');
    }

    public function getLabelNewProduct($created_at) {
        if( Carbon::now()->subDays(7) <= $created_at ) {
            return true;
        }
        return false;
    }

    public function getPriceMinMax() {
        $min = ProductVariation::where('product_id', $this->id)->min('price');
        $max = ProductVariation::where('product_id', $this->id)->max('price');
        return '<span class="product-price tx-sp-cl">$'.number_format($min, 2).' - $'.number_format($max, 2).'</span>';
    }
    public function getMinPrice(){
        $min = ProductVariation::where('product_id', $this->id)->min('price');
        return $min ? $min : 0;
    }
}
