<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinister extends Model
{
    //

    protected $fillable = [
       'code', 'folder','description','contract','vouchers','type1','type2','state'
       ];


       public function subscription()
       {
           # code...

           return $this->hasOne("App\Subscription","code","folder");
       }
}
