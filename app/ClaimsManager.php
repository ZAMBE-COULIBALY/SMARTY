<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimsManager extends Model
{
    //
    protected $table = 'claimsmanagers';

    protected $garded = [
       "*"
    ];
    public function user()
    {
        return $this->hasOne('App\User','username','username');
    }


}
