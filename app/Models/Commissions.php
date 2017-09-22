<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commissions extends Model
{
    protected $table = 'commissions';

    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'type',
        'cost',
        'maximum',
        'product_type'
    ];

    public function category(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
}
