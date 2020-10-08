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
    public function orderDetail()
    {
        return $this->order()->with('fullAddress','shipper','itemsWithType','contacts');
    }
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }
}
