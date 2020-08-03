<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    public function orders(){
        return $this->belongsToMany(Order::class);
    }

    public function itemtype(){
        return $this->belongsTo(Itemtype::class);
    }
    public function deliveryclass(){
        return $this->belongsTo(Deliveryclass::class);
    }
}
