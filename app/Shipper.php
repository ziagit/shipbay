<?php

namespace App;
use App\Address;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function address(){
        return $this->hasOne(Address::class);
    }
    public function fullAddress(){
        return $this->address()->with('country','state','city');
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
