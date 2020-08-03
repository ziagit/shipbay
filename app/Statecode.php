<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statecode extends Model
{
    //
    public function state(){
        return $this->belongsTo(State::class);
    }
}
