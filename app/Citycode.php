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

    public function address(){
        return $this->hasMany(Address::class);
    }
}
