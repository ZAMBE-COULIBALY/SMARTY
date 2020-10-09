<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    //
    protected $table = 'vocabularies';

    protected $guarded = [
        '*'
    ];


    public function attribute($code)
    {
        # code...
        if(property_exists(json_decode($this->attribute),$code))
        return json_decode($this->attribute)->$code;
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
