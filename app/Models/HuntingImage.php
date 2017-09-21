<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HuntingImage extends Model
{
    protected $table = 'hunting_images';

    public $timestamps = true;

    protected $fillable = [
        'product_offers_id',
        'image_path',
        'image_name'
    ];
}
