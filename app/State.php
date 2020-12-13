<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function steteCities()
    {
        return $this->cities()->with('cityZip');
    }
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function carriers()
    {
        return $this->hasMany(Carrier::class);
    }
    public function cityList(){
        return $this->cities()->with('citycodes');
    }
}
