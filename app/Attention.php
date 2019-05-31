<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attention extends Model
{
    public function emergency() {
      return $this->hasOne('App\Emergency');
    }

	public function appointment() {
      return $this->hasOne('App\Appointment');
    }  

    public function patient() {
      return $this->belongsTo('App\Patient','patient_id','id');
    }  
}
