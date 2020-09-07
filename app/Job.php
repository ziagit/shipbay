<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function jobstatus()
    {
        return $this->belongsTo(Jobstatus::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function shipment()
    {
        return $this->order()->with('fullAddress','items');
    }
    public function cityZip()
    {
        return $this->order()->with('fullAddress');
    }
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }
}
