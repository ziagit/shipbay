<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name','state_id'];
    //
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function rates(){
        return $this->belongsToMany(Rate::class)->withPivot('type')->withTimestamps();
    }
 
    public function address(){
        return $this->hasMany(Address::class);
    }

}
