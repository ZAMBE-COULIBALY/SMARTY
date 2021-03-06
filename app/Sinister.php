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

       public function agent()
       {
           # code...
           return $this->belongsTo("App\Agent");
       }  
       
       public function claimsManager()
       {
           # code...
           return $this->belongsTo("App\ClaimsManager","claimsManager_id","id");
       }
}
