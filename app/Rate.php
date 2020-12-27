<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function carriers(){
        return $this->belongsTo(Carrier::class);
    }
    public function cities(){
        return $this->belongsToMany(City::class);
    }
    public function srcdes(){
        return $this->cities()->with('state');
    }


}
