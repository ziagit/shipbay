<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shipper;
class Address extends Model
{
    public function shippers(){
        return $this->belongsToMany(Shipper::class)->withPivot('type');
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function citycode(){
        return $this->belongsTo(Citycode::class);
    }
    
}
