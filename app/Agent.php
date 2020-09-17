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
        return $this->belongsTo("App\Agency");
    }

    public function user()
    {
        return $this->hasOne('App\User','username','username');
    }

    public function subscriptions()
    {
        # code...

        return $this->hasMany('App\Subscription');
    }
}

