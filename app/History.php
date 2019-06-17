<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public function attention()
	{
	  return $this->belongsTo('App\Attention');
	}
}
