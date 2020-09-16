<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    public function carriers(){
        return $this->belongsToMany(Carrier::class)->withPivot(['src_value','des_value'])->withTimestamps();;
    }

    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('type')->withTimestamps();
    }
}
