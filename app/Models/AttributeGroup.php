<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $table = 'attribute_groups';

    public $timestamps = true;

    protected $fillable = [
        'seller_id',
        'name',
        'parent',
        'type',
        'value'
    ];

    public function attributes(){
        return $this->hasMany('App\Models\Attribute');
    }

    public function seller(){
        return $this->hasOne('App\Models\User', 'id', 'seller_id');
    }
}
