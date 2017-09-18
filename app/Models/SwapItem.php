<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwapItem extends Model
{
    protected $table = 'swap_items';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'product_id',
        'note',
        'product_by',
        'created_by',
        'status'
    ];

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function product(){
        return $this->hasOne('App\Models\Product', 'id', 'product_by');
    }
}
