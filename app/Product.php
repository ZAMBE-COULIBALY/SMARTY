<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    protected $garded = [
       "*"
    ];

    public function type()
    {
        # code...
        return $this->hasOne("App\Vocabulary","id","type_id");
    }

    public function category()
    {
        # code...
        return $this->hasOne("App\Vocabulary","id","category_id");
    }

    public function label()
    {
        # code...
        return $this->hasOne("App\Vocabulary","id","label_id");
    }

    public function model()
    {
        # code...
        return $this->hasOne("App\Vocabulary","id","model_id");
    }
}
