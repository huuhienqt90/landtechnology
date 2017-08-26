<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $table = 'product_reviews';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'message',
        'rating',
        'user_id',
        'status'
    ];
}
