<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function user()
	{
	  return $this->belongsTo('App\User');
	}
	public function attention()
	{
	  return $this->hasMany('App\Attention');
	}
}
