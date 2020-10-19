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
    public function itemsWithType(){
        return $this->items()->with('itemtype');
    }
    public function accessories()
    {
        return $this->belongsToMany(Accessory::class)->withPivot('type')->withTimestamps();
    }
    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }
    public function addresses(){
        return $this->belongsToMany(Address::class);
    }
    public function fullAddress(){
        return $this->addresses()->with('country');
    }
    public function contacts(){
        return $this->belongsToMany(Contact::class);
    }
    public function job()
    {
        return $this->hasOne(Job::class);
    }
    public function jobWithStatus(){
        return $this->job()->with('jobstatus');
    }
}
