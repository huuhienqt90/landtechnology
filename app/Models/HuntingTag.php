<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HuntingTag extends Model
{
    protected $table = 'hunting_tags';

    public $timestamps = true;

    protected $fillable = [
        'hunting_id',
        'tag_id',
    ];
}
