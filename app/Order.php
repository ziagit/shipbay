<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
    public function accessories()
    {
        return $this->belongsToMany(Accessory::class)->withPivot('type')->withTimestamps();
    }
    public function cities()
    {
        return $this->belongsToMany(City::class)->withPivot('type')->withTimestamps();
    }
    public function citycodes()
    {
        return $this->belongsToMany(Citycode::class)->withPivot('type')->withTimestamps();
    }
    public function cityZip(){
        return $this->citycodes()->with('cities');
    }

    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }
    public function addresses(){
        return $this->shipper()->with('srcDes');
    }
    public function job()
    {
        return $this->hasOne(Job::class);
    }
}
