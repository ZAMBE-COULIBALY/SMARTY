<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transsubscription extends Model
{
    //

    protected $fillable = [
        'equipment','model','mark','numberIMEI','picture', 'price', 'date_subscription','name', 'first_name', 'birth_date', 'gender', 'place_birth','place_residence','marital_status',  'phone1','phone2', 'mail',
    ];
}
