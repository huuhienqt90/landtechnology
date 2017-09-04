<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;

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

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function products() {
        return $this->belongsToMany('App\Models\Product');
    }

    public function showParent(){
        if(static::where('parent_id', $this->parent)->count()){
            return static::where('parent_id', $this->parent)->first()->name;
        }else{
            return null;
        }
    }
}