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

    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }

    public function shipmentaddresses(){
        return $this->belongsToMany(Shipmentaddress::class)->withPivot('type');
    }
    public function fullAddress(){
        return $this->shipmentaddresses()->with('country','state','city', 'citycode');
    }
    public function job()
    {
        return $this->hasOne(Job::class);
    }
    public function jobWithStatus(){
        return $this->job()->with('jobstatus');
    }
}
