<?php

namespace App\Http\Controllers\Shipper;

use App\Address;
use App\Http\Controllers\Controller;
use App\Shipper;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ShipperDetailsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = JWTAuth::user()->id;
        $shipper = Shipper::with('user', 'fullAddress')->where('user_id', $userId)->first();
        return response()->json($shipper);
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
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' =>'required',
            'phone' =>'required|unique:shippers',
            'country' =>'required',
            'state' =>'required',
            'city' =>'required',
            'citycode' =>'required',
        ]);

        $shipper = new Shipper();
        $shipper->first_name = $request->firstName;
        $shipper->last_name = $request->lastName;
        $shipper->phone = $request->phone;
        $shipper->user_id = JWTAuth::user()->id;

        if(!$shipper->save()){
            return response()->json(["message"=>"Couldn't save"],409);
        }
        $this->storeAddress($request,$shipper->id);
      
        return response()->json(["message"=>"Saved successfully!"],200);
    }
    public function storeAddress($request, $shipperId){

        $address = new Address();
        $address->address = $request->address;
        $address->country_id = $request->country;
        $address->state_id = $request->state;
        $address->city_id = $request->city;
        $address->citycode = $request->citycode;
        $address->shipper_id = $shipperId;
        $address->save();
        return $address;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\shipper  $shipper
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shipper = Shipper::with('user', 'fullAddress')->find($id);
        return $shipper;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\shipper  $shipper
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipper  $shipper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' =>'required',
            'phone' =>'required',
            'country' =>'required',
            'state' =>'required',
            'city' =>'required',
            'citycode' =>'required',
        ]);

        $shipper = Shipper::find($id);
        $shipper->first_name = $request->firstName;
        $shipper->last_name = $request->lastName;
        $shipper->phone = $request->phone;
        $shipper->user_id = JWTAuth::user()->id;
        $shipper->update();
        $this->updateAddress($request,$shipper->id);
      
        return response()->json(["message"=>"Updated successfully!"],200);
    }
    public function updateAddress($request, $shipperId){
        $address = Address::find($request->addressId);
        $address->address = $request->address;
        $address->country_id = $request->country;
        $address->state_id = $request->state;
        $address->city_id = $request->city;
        $address->citycode = $request->citycode;
        $address->shipper_id = $shipperId;
        $address->update();
        return $address;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\shipper  $shipper
     * @return \Illuminate\Http\Response
     */
    public function destroy(shipper $shipper)
    {
        // 
    }

}
