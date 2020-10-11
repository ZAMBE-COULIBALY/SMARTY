<?php

namespace App;

use Carbon\Carbon;
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

    public function sinisters()
    {
        # code...
        return $this->hasMany("App\Sinister","folder","code");
    }

    public function pack()
    {
        # code...
        return $this->hasMany("App\Pack","subscription_id","id");
    }


    public function currentValue()
    {
        # code...
        $currentValue = $this->price;
        $currentInterval = now()->diffInDays($this->created_at);
        switch ($this->pack->first()->product->category->attribute("ASS-TYP")) {
            case 'DP':
                # code...
                if ($currentInterval > 365) {
                    # code...
                    $currentValue = 0;
                }
                elseif($currentInterval > 180)
                {
                    $currentValue = 0.5 * $currentValue;
                } elseif ($currentInterval > 90) {
                    # code...
                    $currentValue = 0.7 * $currentValue;

                }
                return $currentValue;
                break;

            default:
                # code...
                return $currentValue;

                break;
        }
        return $currentValue;


    }

    public function currentState()
    {
        # code...
        $currentState = $this->state;
        $currentInterval = now()->diffInDays($this->created_at);
        if ($currentState !=0 ) {
            # code...

             switch ($this->pack->first()->product->category->attribute("ASS-TYP")) {
            case 'DP':
                # code...
                if ($currentInterval > 365) {
                    # code...
                    $currentState = 0;
                }
                elseif($currentInterval > 180)
                {
                    $currentState = 3;
                } elseif ($currentInterval > 90) {
                    # code...
                    $currentState = 2;

                }
                return $currentState;
                break;

            default:
                # code...
                return $currentState;

                break;
        }
        }

        return $currentState;


    }
}
