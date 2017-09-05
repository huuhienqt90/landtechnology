<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';

    public $timestamps = true;

    protected $fillable = [
        'group_id',
        'name',
        'options'
    ];

    public function group(){
        return $this->hasOne('App\Models\AttributeGroup', 'id', 'group_id');
    }
}
