<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliveryclass extends Model
{
    public function items(){
        return $this->hasMany(Order::class);
    }
}
