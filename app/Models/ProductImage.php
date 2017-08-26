<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'image_path',
        'image_name'
    ];
}
