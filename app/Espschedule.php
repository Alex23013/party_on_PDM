<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Espschedule extends Model
{
    public function doctor()
	{
	  return $this->belongsTo('App\Doctor');
	}
}
