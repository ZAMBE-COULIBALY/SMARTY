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
        return $this->hasOne("App\Partner");
    }

    public function agency()
    {
        # code...
        return $this->hasMany("App\Agency","manager_id");
    }
}
