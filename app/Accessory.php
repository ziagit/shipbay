<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    public function carriers(){
        return $this->belongsToMany(Carrier::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('type')->withTimestamps();
    }
}
