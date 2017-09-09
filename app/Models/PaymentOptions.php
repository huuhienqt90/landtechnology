<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentOptions extends Model
{
    protected $table = 'payment_options';

    public $timestamps = true;

    protected $fillable = [
        'payment_id',
        'key',
        'value'
    ];
}
