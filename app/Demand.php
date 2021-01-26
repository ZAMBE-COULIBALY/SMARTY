<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    //
    protected $table = 'demands';

    protected $garded = [
       "*"
    ];
    protected $casts = [
        'details' => 'array',
        ];

    public function detail($code)
    {
        # code...

        if(array_key_exists($code,json_decode($this->details,true)))
        return json_decode($this->details,true)[$code];
        return [];
    }




    public function hasAttribute($attribute,$type)
    {
        # code...
        if(null !== $this->attribute)
        {
                if (collect($this->attribute($type))->contains($attribute)) {
                return true;
            }

        }

        return false;
    }
}
