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
        return json_decode($this->attribute)->$code;
    }
}
