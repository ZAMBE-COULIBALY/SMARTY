<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    //
    protected $table = 'agents';

    protected $garded = [
       "*"
    ];

    public function agency()
    {
        # code...
        return $this->hasOne("App\Agency");
    }

    public function user()
    {
        return $this->hasOne('App\User','username','username');
    }
}

