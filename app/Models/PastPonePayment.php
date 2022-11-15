<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastPonePayment extends Model
{
    protected $fillable = [
        'payment_id',
        'status_id',
        'is_completed',
        'signature'
    ];
}
