<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shipper;
class Address extends Model
{

    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }

    public function citycode(){
        return $this->belongsTo(Citycode::class);
    }

    public function shipper(){
        return $this->belongsTo(Shipper::class);
    }
    public function carrier(){
        return $this->belongsTo(Carrier::class);
    }
    
}
