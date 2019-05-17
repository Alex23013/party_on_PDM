<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function partners()
    {
        return $this->belongsToMany(Partner::class,'partner_services')->withPivot('active');
    }
}
	