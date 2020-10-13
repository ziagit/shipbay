<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;

class Carrier extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function contact(){
        return $this->belongsTo(Contact::class);
    }
    public function customeraddress(){
        return $this->belongsTo(Customeraddress::class);
    }
    public function fullAddress(){
        return $this->customeraddress()->with('country','state','city','zip','address');
    }
    public function rates(){
        return $this->belongsToMany(Rate::class);
    }
    public function carrierRates(){
        return $this->rates()->with('cities');
    }
    public function rateWithCity(){
        return $this->rates()->with('cityWithState');
    }
    public function accessories(){
        return $this->belongsToMany(Accessory::class)->withPivot(['src_value', 'des_value']);
    }
    public function jobs(){
        return $this->hasMany(Job::class);
    }
}
