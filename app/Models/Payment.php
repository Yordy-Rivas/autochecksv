<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',

        'transaction_id',

        'card_holder',

        'last_digits',

        'email',

        'postal_code',

        'amount',

        'status'

    ];
}
