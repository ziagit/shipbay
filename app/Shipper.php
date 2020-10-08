<?php

namespace App;
use App\Address;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function contact(){
        return $this->belongsTo(Contact::class);
    }
    public function address(){
        return $this->belongsTo(Customeraddress::class);
    }
    public function fullAddress(){
        return $this->address()->with('country','state','city','zip','address');
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
