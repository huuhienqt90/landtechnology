<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class PaymentMethod extends Model
{
    use Sluggable;

    protected $table = 'payment_methods';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
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
}
