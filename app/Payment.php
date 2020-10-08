<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'refsubscription','paymentmethod', 'refpayment','datepayment','amount','customer_id',

            ];
}
