<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBooking extends Model
{
    protected $table = 'product_bookings';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'price',
        'sale_price',
        'date_time_booking',
        'option_booking'
    ];

    public function product(){
        return $this->hasOne('App\Models\Product');
    }

    public function getPrice(){
        if( $this->sale_price > 0 && $this->price > $this->sale_price){
            return '<span class="tx-sp-line-through">$'.number_format($this->price, 2).'</span> <span class="product-price tx-sp-cl">$'.number_format($this->sale_price, 2). '</span>';
        }else{
            return '<span class="product-price tx-sp-cl">$'.number_format($this->price, 2). '</span>';
        }
    }
}
