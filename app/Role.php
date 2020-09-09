<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles';

    protected $guarded = ['*'];


    public function users()
    {
        return $this->belongsToMany('App\User','auhtorisations','role_id','user_id');
    }
}
