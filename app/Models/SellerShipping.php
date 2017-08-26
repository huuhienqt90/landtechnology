<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerShipping extends Model
{
    protected $table = 'seller_shippings';

    public $timestamps = true;

    protected $fillable = [
        'seller_id',
        'from_country',
        'to_country',
        'cost'
    ];
}
