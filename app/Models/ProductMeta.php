<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    protected $table = 'product_metas';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'key',
        'value'
    ];
}
