<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    public function appointment()
	{
	  return $this->hasOne('App\Appointment');
	} 
}
