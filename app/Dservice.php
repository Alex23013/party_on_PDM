<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dservice extends Model
{
    public function user()
	{
	  return $this->belongsTo('App\User');
	}

	public function partner()
	{
	  return $this->belongsTo('App\Partner');
	}

	public function service()
	{
	  return $this->belongsTo('App\Service');
	}
}
