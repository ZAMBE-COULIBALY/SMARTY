<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    //
    protected $table = 'packs';

    protected $guarded = [
        '*'
    ];


    public function product()
    {
        # code...
        return $this->belongsTo("App\Product","product_id","id");
    }


    public function subscription()
    {
        # code...
        return $this->hasOne("App\Subscription");
    }


}
