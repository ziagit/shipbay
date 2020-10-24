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
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function fullAddress(){
        return $this->address()->with('country');
    }
    public function rates(){
        return $this->hasMany(Rate::class);
    }
    public function rateaddress(){
        return $this->rates()->with('addresses');
    }

    public function accessories(){
        return $this->belongsToMany(Accessory::class)->withPivot(['src_value', 'des_value']);
    }
    public function jobs(){
        return $this->hasMany(Job::class);
    }
}
