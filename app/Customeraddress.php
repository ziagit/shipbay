<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customeraddress extends Model
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
    public function zip(){
        return $this->belongsTo(Citycode::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function carrier(){
        return $this->hasOne(Carrier::class);
    }
    public function shipper(){
        return $this->hasOne(Shipper::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
