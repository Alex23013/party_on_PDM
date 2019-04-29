<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner_service extends Model
{
    public function partner()
	{
	  return $this->belongsTo('App\Partner');
	}
}
