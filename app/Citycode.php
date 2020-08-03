<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citycode extends Model
{
    //
    public function cities(){
        return $this->belongsToMany(City::class);
    }
    public function citycodeCity(){
        return $this->cities()->with('state');
    }
    public function carriers(){
        return $this->hasMany(Carrier::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('type')->withTimestamps();
    }
    public function rates(){
        return $this->belongsToMany(Rate::class)->withPivot('type')->withTimestamps();
    }

    public function address(){
        return $this->hasMany(Address::class);
    }
}
