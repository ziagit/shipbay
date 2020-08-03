<?php

namespace App\Http\Controllers;

use App\Accessory;
use App\Carrier;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessories = Accessory::all();
        return $accessories;
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

        $accessory = Accessory::find($request->name);
        $carrier = Carrier::find($carrierId);

        if ($carrier->accessories->contains($accessory)) {
            return "Duplicate intry";
        } else {
            $carrier->accessories()->attach($accessory, ['src_value' => $request->srcValue, 'des_value' => $request->desValue]);
            return response()->json("OK", 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function show($carrierId)
    {
        $carrier = Carrier::with('accessories')->where('id', $carrierId)->get('id');
        return $carrier;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function edit($accessoryId, $carrierId)
    {
        $accessory = Carrier::find($carrierId)->accessories()->find($accessoryId);
        return $accessory;
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $accessoryId, $carrierId)
    {
        $carrier = Carrier::find($carrierId);
        $accessory = Accessory::find($accessoryId);

        $newAccessory = Accessory::find($request->name);

        $carrier->accessories()->detach($accessory);
        $carrier->accessories()->attach($newAccessory, ['src_value' => $request->srcValue, 'des_value' => $request->desValue]);
        return response()->json("OK", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function destroy($accessoryId, $carrierId)
    {
        $accessory = Accessory::find($accessoryId);
        $carrier = Carrier::find($carrierId);
        $carrier->accessories()->detach($accessory);
        return "deleted";
    }
}
