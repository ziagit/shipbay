<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citycode extends Model
{
    protected $fillable = ['postal_code','address_id'];
    public function address(){
        return $this->belongsTo(Address::class);
    }
}
