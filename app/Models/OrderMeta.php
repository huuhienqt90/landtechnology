<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMeta extends Model
{
    protected $table = 'order_metas';

    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'key',
        'value'
    ];

    public function order(){
    	return $this->hasMany('App\Models\Order', 'id', 'order_id');
    }
}
