<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    public function state(){
        return $this->belongsTo(State::class);
    }

    public function rates(){
        return $this->belongsToMany(Rate::class);
    }

}
