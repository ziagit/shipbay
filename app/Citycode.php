<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citycode extends Model
{
    //
    public function cities(){
        return $this->belongsTo(City::class);
    }
    public function citycodeCity(){
        return $this->cities()->with('state');
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }
}
