<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name','username','state','email','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role','authorisations','user_id','role_id');
    }

    public function agent()
    {
        return $this->hasOne('App\Agent','username','username');
    }

    public function manager()
    {
        return $this->hasOne('App\Manager','username','username');
    }
    public function claimsManager()
    {
        return $this->hasOne('App\ClaimsManager','username','username');
    }

    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }


    public function hasRole($role)
    {
        if ($this->roles()->where('slug', $role)->first()) {
            return true;
        }
        return false;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }

            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return  false;
    }
}
