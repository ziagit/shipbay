<?php

namespace App\Http\Controllers\Carrier;

use App\Http\Controllers\Controller;
use App\carrier;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Address;

class CarrierDetailsController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = JWTAuth::user()->id;
        $carrier = Carrier::with('user', 'fullAddress')->where('user_id', $userId)->first();
        return response()->json($carrier);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:carriers',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'citycode' => 'required',
        ]);


        if ($request->hasFile('logo')) {
            //        for production only   
            /*             $path = base_path();
                        $path = str_replace("coffee54", "public_html", $path);
                        $destinationPath = $path . '/images/coffeequery'; */

            $file = $request->file('logo');
            $logo_name = time() . '.' . $file->getClientOriginalName();

            /* $image->move($destinationPath, $image_name); */
            $file->move(public_path('images/uploads'), $logo_name);
        } else {
            $logo_name = "logo not available";
        }

        $carrier = new Carrier();
        $carrier->first_name = $request->first_name;
        $carrier->last_name = $request->last_name;
        $carrier->phone = $request->phone;
        $carrier->website = $request->website;
        $carrier->company = $request->company;
        $carrier->detail = $request->detail;
        $carrier->logo = $logo_name;
        $carrier->user_id = JWTAuth::user()->id;

        $carrier->save();
        $this->storeAddress($request, $carrier->id);

        return response()->json(["message" => "Saved successfully!"],200);
    }
    public function storeAddress($request, $carrierId)
    {

        $address = new Address();
        $address->address = $request->address;
        $address->country_id = $request->country;
        $address->state_id = $request->state;
        $address->city_id = $request->city;
        $address->citycode = $request->citycode;
        $address->carrier_id = $carrierId;
        $address->save();
        return $address;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carrier = Carrier::with('user', 'fullAddress')->find($id);
        return $carrier;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'citycode' => 'required',
        ]);
        $carrier = Carrier::find($id);

        if ($request->hasFile('logo')) {
            /*          for production only   
                        $path = base_path();
                        $path = str_replace("coffee54", "public_html", $path);
                        $destinationPath = $path . '/images/coffeequery'; 
                        $old_image_path = $destinationPath.'/'.$project->name;
                        */
            $old_image_path = public_path('images/uploads/' . $carrier->logo);
            if (file_exists($old_image_path)) {
                @unlink($old_image_path);
            }
            $file = $request->file('logo');
            $logo_name = time() . '.' . $file->getClientOriginalName();
            /* $image->move($destinationPath, $image_name); */
            $file->move(public_path('images/uploads'), $logo_name);
        } else {
            $logo_name = $carrier->logo;
        }

        $carrier->first_name = $request->first_name;
        $carrier->last_name = $request->last_name;
        $carrier->phone = $request->phone;
        $carrier->website = $request->website;
        $carrier->company = $request->company;
        $carrier->detail = $request->detail;
        $carrier->logo = $logo_name;
        $carrier->user_id = JWTAuth::user()->id;
        $carrier->update();
        $this->updateAddress($request, $carrier->id);

        return response()->json(["message" => "Updated successfully!"],200);
    }
    public function updateAddress($request, $carrierId)
    {
        $address = Address::find($request->addressId);
        $address->address = $request->address;
        $address->country_id = $request->country;
        $address->state_id = $request->state;
        $address->city_id = $request->city;
        $address->citycode = $request->citycode;
        $address->carrier_id = $carrierId;
        $address->update();
        return $address;
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
}
