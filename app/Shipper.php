<?php

namespace App;
use App\Address;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    public function addresses(){
        return $this->belongsToMany(Address::class)->withPivot('type');
    }
    public function srcDes(){
        return $this->addresses()->with('city', 'citycode');
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
