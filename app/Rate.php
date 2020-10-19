<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function carriers(){
        return $this->belongsTo(Carrier::class);
    }
    public function addresses(){
        return $this->belongsToMany(Address::class);
    }


}
