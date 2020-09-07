<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipmentaddress extends Model
{
    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('type');
    }
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
}
