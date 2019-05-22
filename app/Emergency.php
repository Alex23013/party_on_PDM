<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    public function attention()
	{
	  return $this->belongsTo('App\Attention');
	}
}
