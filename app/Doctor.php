<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function user()
	{
	  return $this->belongsTo('App\User');
	}

	 public function appointment()
	{
	  return $this->hasMany('App\Appointment');
	}
}
