<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public function services()
    {
        return $this->belongsToMany(Service::class,'partner_services')->withPivot('active');

    }
}
