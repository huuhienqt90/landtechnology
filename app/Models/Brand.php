<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
    use Sluggable;

    protected $table = 'brands';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'image',
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

    public function author() {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function updator() {
        return $this->hasOne('App\Models\User', 'id', 'updated_by');
    }

}
