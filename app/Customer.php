<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //

    protected $fillable = [
      'code','name', 'first_name', 'birth_date', 'gender', 'place_birth','marital_status', 'place_residence', 'phone1','phone2', 'mail',
    ];
}
