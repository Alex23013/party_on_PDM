<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function patient() {
      return $this->hasOne('App\Patient');
    }

    public function doctor() {
      return $this->hasOne('App\Doctor');
    }

    public function triage() {
      return $this->hasOne('App\Triage');
    }

    public function attentions()
    {
      return $this->hasMany('App\Attention');
    }
}
