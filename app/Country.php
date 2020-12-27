<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    public function addresses(){
        return $this->hasMany(Address::class);
    }
    public function states(){
        return $this->hasMany(State::class);
    }
}
