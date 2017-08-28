<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'category_id'
    ];

    /**
     * Get the product record associated with the category.
     */
    public function product()
    {
        return $this->hasOne('App\Models\Product');
    }

    /**
     * Get the category record associated with the product.
     */
    public function category(){
        return $this->hasOne('App\Models\Category');
    }
}
