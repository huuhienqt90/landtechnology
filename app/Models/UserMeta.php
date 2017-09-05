<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $table = 'user_metas';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'key',
        'value'
    ];
}
