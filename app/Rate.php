<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function carriers(){
        return $this->belongsToMany(Carrier::class);
    }
    public function citycodes(){
        return $this->belongsToMany(Citycode::class)->withPivot('type')->withTimestamps();
    }
    public function rateCitycode(){
        return $this->citycodes()->with('citycodeCity');
    }
}
