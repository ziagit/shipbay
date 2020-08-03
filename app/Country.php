<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    public function states(){
        return $this->hasMany('App\State');
    }
    public function countryStates(){
        return $this->states()->with('steteCities');
    }

    public function carriers(){
        return $this->hasMany('App\Carrier');
    }
    public function stateList(){
        return $this->states()->with('cityList');
    }
}
