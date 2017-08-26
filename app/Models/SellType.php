<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellType extends Model
{
    protected $table = 'sell_types';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'created_by',
        'updated_by'
    ];
}
