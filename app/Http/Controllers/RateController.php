<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrier;
use App\rate;
use App\State;
use App\City;
use App\Citycode;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $carrierId)
    {
        
        $rate = new Rate();
        $rate->min_rate = $request->min_rate;
        $rate->_0k_1k = $request->k0_k1;
        $rate->_1k_2k = $request->k1_k2;
        $rate->_2k_3k = $request->k2_k3;
        $rate->_3k_4k = $request->k3_k4;
        $rate->_4k_5k = $request->k4_k5;
        $rate->_5k_10k = $request->k5_k10;
        $rate->above_10k = $request->above_10k;
        $rate->fsc = $request->fsc;
        $rate->transit_day = $request->transit_day;

        $rate->save();

        $carrier = Carrier::find($carrierId);
        $rate->carriers()->attach($carrier);

        $rate->citycodes()->attach($request->src_zip,['type'=>'src']);
        $rate->citycodes()->attach($request->des_zip,['type'=>'des']);
        return "Saved.";
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $states = Carrier::with('carrierRates')->find($id);
        return $states;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $rate = Rate::with('rateCitycode')->find($id);
        return $rate;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $rate = Rate::find($id);
        $rate->min_rate = $request->min_rate;
        $rate->_0k_1k = $request->k0_k1;
        $rate->_1k_2k = $request->k1_k2;
        $rate->_2k_3k = $request->k2_k3;
        $rate->_3k_4k = $request->k3_k4;
        $rate->_4k_5k = $request->k4_k5;
        $rate->_5k_10k = $request->k5_k10;
        $rate->above_10k = $request->above_10k;
        $rate->fsc = $request->fsc;
        $rate->transit_day = $request->transit_day;

        $rate->update();

        $rate->citycodes()->detach();

        $rate->citycodes()->attach($request->src_zip,['type'=>'src']);
        $rate->citycodes()->attach($request->des_zip,['type'=>'des']);
        return "updated.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy($rateId)
    {
        $rate = Rate::find($rateId);
        $rate->citycodes()->detach();
        $rate->delete();
        return "deleted";
    }
}
