<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //

    protected $fillable = [
     'libellepdv','pdv_id','dat','equipmentLibelle','marquelibelle','modellibelle','agent_id','premium','subscription_enddate','date_deb','date_fin','equipmentLibelle','modellibelle','marquelibelle', 'customer_id','folder', 'mailing_address','equipment','model','mark','numberIMEI','picture', 'price', 'date_subscription','code','name', 'first_name', 'birth_date', 'gender', 'place_birth','place_residence','marital_status',  'phone1','phone2', 'mail',
    ];

    public function customer()
    {
        # code...
        return $this->belongsTo('App\Customer');
    }

    public function agent()
    {
        # code...
        return $this->belongsTo("App\Agent");
    }

    public function product()
    {
        # code...
        return $this->belongsTo("App\Product");
    }
}
