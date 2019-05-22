<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function attention()
	{
	  return $this->belongsTo('App\Attention');
	}
}
