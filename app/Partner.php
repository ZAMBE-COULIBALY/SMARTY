<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    //
    protected $table = 'partners';

    protected $garded = [
       "*"
    ];

    public function agency()
    {
        # code...

        return $this->hasMany('App\Agency','partner_id');
    }

    public function admin()
    {
        # code...
        return $this->hasOne("App\User","id","admin_id");
    }

    public function managers()
    {
        # code...
        return $this->hasMany("App\Manager","partner_id");
    }

    public function hasCategory($category)
    {
        # code...
        if(null !== $this->category)
        {
                if (collect(json_decode($this->category))->contains($category)) {
                return true;
            }

        }

        return false;
    }

    public function Product()
    {
        # code...
        return $this->hasMany("App\Product");
    }


}
