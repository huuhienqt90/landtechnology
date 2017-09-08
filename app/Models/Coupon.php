<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'description',
        'type_discount',
        'cost',
        'minimum',
        'maximum',
        'limit_usage',
        'products_id',
        'categories_id',
        'start_date',
        'expiry_date',
        'create_by',
        'update_by'
    ];
}
