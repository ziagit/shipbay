<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;

class Carrier extends Model
{
/*     protected $fillable = [
        
    ]; */
    //
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
        return $this->belongsToMany(Accessory::class)->withPivot(['src_value', 'des_value'])->withTimestamps();
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function citycode(){
        return $this->belongsTo(Citycode::class);
    }
    public function jobs(){
        return $this->hasMany(Job::class);
    }
/*     public function states(){
        return $this->hasManyThrough('App\State', 'App\Rate');
    } */
}
