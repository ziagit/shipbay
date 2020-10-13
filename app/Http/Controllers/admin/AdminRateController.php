<?php

namespace App\Http\Controllers\Admin;

use App\Carrier;
use App\Http\Controllers\Controller;
use App\Rate;
use Illuminate\Http\Request;

class AdminRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rates = Rate::with('carriers','cityWithState')->paginate(10);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
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

        $rate->cities()->detach();

        $rate->cities()->attach($request->src_city, ['type' => 'src']);
        $rate->cities()->attach($request->des_city, ['type' => 'des']);
        return response()->json(['message' => 'Updated successfully!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
