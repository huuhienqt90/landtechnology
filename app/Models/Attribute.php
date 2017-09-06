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

    public static function getValuesById($id = 0){
        if( $id ){
            $attrs = static::find($id);
            if($attrs->options){
                return explode(',', $attrs->options);
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
}
