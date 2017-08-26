<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'image',
        'status',
        'index',
        'attributes',
        'created_by',
        'updated_by'
    ];
}
