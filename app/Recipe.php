<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function appointment()
	{
	  return $this->belongsTo('App\Appointment');
	}
}
