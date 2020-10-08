<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    //

    protected $fillable = [
'refsubscription','paymentmethod', 'refpayment','datepayment','amount','customer_id',

    ];

    public function subscription()
    {
        # code...
        return $this->belongsTo("App\Subscription");
    }

}
