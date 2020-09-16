<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;

class Carrier extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function rates(){
        return $this->belongsToMany(Rate::class);
    }
    public function carrierRates(){
        return $this->rates()->with('rateCitycode');
    }

    public function accessories(){
        return $this->belongsToMany(Accessory::class);
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function address(){
        return $this->hasOne(Address::class);
    }
    public function fullAddress(){
        return $this->address()->with('country','state','city');
    }
}
