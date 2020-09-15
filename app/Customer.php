<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //

    protected $fillable = [
     'libellepdv','codepdv','date_deb','date_fin', 'code','name', 'first_name','mailing_address','folder', 'birth_date', 'gender', 'place_birth','marital_status', 'place_residence', 'phone1','phone2', 'mail',
    ];

    public function subscriptions()
    {
        # code...

        return $this->hasMany('App\Subscription');
    }
}

