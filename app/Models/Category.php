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

    public function author() {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function updator() {
        return $this->hasOne('App\Models\User', 'id', 'updated_by');
    }

    public function showParent(){
        if(static::where('id', $this->parent_id)->count()){
            return static::where('id', $this->parent_id)->first()->name;
        }else{
            return null;
        }
    }

    public function getChildren(){
        return static::where('parent_id', $this->id)->get();
    }
}
