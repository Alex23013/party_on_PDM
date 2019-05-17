<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\partners;

class Service extends Model
{
    public function partners()
    {
        return $this->belongsToMany(Partner::class,'partner_services')->withPivot('active');
    }
}
