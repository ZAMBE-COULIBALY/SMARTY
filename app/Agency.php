<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    //
    protected $table = 'agencies';

    protected $guarded = [
        '*'
    ];


    public function partner()
    {
        # code...
        return $this->belongsTo('App\Partner','partner_id');
    }
    public function chief()
    {
        # code...
        return $this->hasOne('App\Agent','id','chief_id');
    }

    public function agents()
    {
        # code...
        return $this->hasMany('App\Agent');
    }

}
