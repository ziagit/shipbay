<?php

namespace App\Http\Controllers;

use App\carrier;
use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;
use App\Citycode;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Accessory;

class CarrierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $userId = JWTAuth::user()->id;
        $carrier = new Carrier();
        $carrier->first_name = $request->first_name;
        $carrier->last_name = $request->last_name;
        $carrier->address = $request->address;
        $carrier->phone = $request->phone;
        $carrier->website = $request->website;
        $carrier->company = $request->company;
        $carrier->detail = $request->detail;
        $carrier->logo = $request->logo;

        $carrier->user_id = $userId;

        $carrier->country_id = $request->country;
        $carrier->state_id = $request->state;
        $carrier->city_id = $request->city;
        $carrier->citycode_id = $request->citycode;
        $carrier->save();

        return "saved";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $userId = JWTAuth::user()->id;
        $carrier = Carrier::with('user', 'country', 'state', 'city', 'citycode')->where('user_id', $userId)->get();
        return $carrier;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function edit($carrierId)
    {
        $carrier = Carrier::with('user', 'country', 'state', 'city', 'citycode')->where('id', $carrierId)->get();
        return $carrier;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $carrierId)
    {
        $carrier = Carrier::find($carrierId);
        $userId = JWTAuth::user()->id;
        $carrier->first_name = $request->first_name;
        $carrier->last_name = $request->last_name;
        $carrier->address = $request->address;
        $carrier->phone = $request->phone;
        $carrier->website = $request->website;
        $carrier->company = $request->company;
        $carrier->detail = $request->detail;
        $carrier->logo = $request->logo;

        $carrier->user_id = $userId;

        $carrier->country_id = $request->country;
        $carrier->state_id = $request->state;
        $carrier->city_id = $request->city;
        $carrier->citycode_id = $request->citycode;
        if ($carrier->update()) {
            return "updated successed.";
        } else {
            return "faild";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function destroy(carrier $carrier)
    {
        // 
    }

    public function countries()
    {
        $countries = Country::all();
        return $countries;
    }
    public function states($id)
    {
        $states = State::with('cities')->where('country_id', '=', $id)->get();
        return $states;
    }
    public function cities($id)
    {
        $cities = City::where('state_id', '=', $id)->get();
        $accessories = Accessory::all();
        return compact('cities', 'accessories');
    }
    public function citiescode($id)
    {
        $states = Citycode::where('city_id', $id)->get();
        return $states;
    }
}
