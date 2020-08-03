<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('type')->withTimestamps();
    }

    public function citycodes(){
        return $this->belongsToMany(Citycode::class);
    }
    public function cityZip(){
        return $this->citycodes()->with('rates');
    }

    public function carriers(){
        return $this->hasMany(Carrier::class);
    }
    public function address(){
        return $this->hasMany(Address::class);
    }
}
