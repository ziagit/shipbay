<?php

namespace App\Http\Controllers\Carrier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Carrier;
use App\Rate;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $carrierId = Carrier::where('user_id', $userId)->first('id')->id;
        $rates = Carrier::with('rateaddress')->find($carrierId);
        return response()->json($rates);
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
    public function store(Request $request)
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
        $rate->carrier_id = $request->carrierId;

        $rate->save();

        $rate->cities()->attach($request->src_city);
        $rate->cities()->attach($request->des_city);
        return response()->json(['message' => 'Saved successfully!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rate = Rate::with('srcdes')->find($id);
        return response()->json($rate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //
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
        $rate->carrier_id = $request->carrierId;

        $rate->update();

        $rate->cities()->detach();

        $rate->cities()->attach($request->src_city);
        $rate->cities()->attach($request->des_city);
        return response()->json(['message' => 'Updated successfully!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy($rateId)
    {
        $rate = Rate::find($rateId);
        $rate->cities()->detach();
        $rate->delete();
        return response()->json(["message"=>"Deleted successfully!"],200);
    }
    public function search(Request $request)
    {
        $userId = Auth::user()->id;
        $carrierId = Carrier::where('user_id', $userId)->first('id')->id;
        $rates = Carrier::with('carrierRates')->find($carrierId);
        return $rates;
        $keywords = $request->keywords;
        $citycodes = Rate::where('min_rate', 'like', '%' . $keywords . '%')
            ->orWhereHas('citycodes', function ($q) use ($keywords) {
                return $q->where('postal_code', 'like', '%' . $keywords . '%');
            })
            ->with('citycodes')
            ->paginate(5);
        return $citycodes;

      
    }
}
