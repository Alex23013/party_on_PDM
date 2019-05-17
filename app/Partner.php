<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;

class Partner extends Model
{
    public function services()
    {
        return $this->belongsToMany(Service::class,'partner_services')->withPivot('active');

    }
}

/*
public function products()
{
    return $this->belongsToMany('App\Product', 'products_shops', 
      'shops_id', 'products_id');
}

*/
