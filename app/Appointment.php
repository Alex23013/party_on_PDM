<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function attention()
	{
	  return $this->belongsTo('App\Attention');
	}

	public function specialty() {
      return $this->belongsTo('App\Specialty');
    } 

    public function doctor() {
      return $this->belongsTo('App\Doctor','doctor_id','id');
    } 
}
