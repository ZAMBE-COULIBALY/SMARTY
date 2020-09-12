<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    //
    protected $table = 'managers';

    protected $garded = [
       "*"
    ];

    public function partner()
    {
        # code...
        return $this->belongsTo("App\Partner");
    }

    public function agency()
    {
        # code...
        return $this->hasMany("App\Agency","manager_id");
    }

    public function user()
    {
        return $this->hasOne('App\User','username','username');
    }
}
