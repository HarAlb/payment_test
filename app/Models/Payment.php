<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'merchant_id',
        'status_id',
        'payment_id',
        'amount',
        'amount_paid',
        'signature'
    ];
}
