<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function carriers(){
        return $this->belongsToMany(Carrier::class);
    }
    public function cities(){
        return $this->belongsToMany(City::class)->withPivot('type')->withTimestamps();
    }

    public function cityWithState(){
        return $this->cities()->with('state');
    }


/*     public function rateCitycode(){
        return $this->citycodes()->with('citycodeCity');
    } */
}
