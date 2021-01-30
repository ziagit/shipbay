<?php

namespace App\Http\Controllers\Shipper;

use App\Address;
use App\Contact;
use App\Customeraddress;
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
        $carrier = Shipper::with('fullAddress','contact')->where('user_id', $userId)->first();
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
            'phone' => 'required|unique:contacts',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'address' => 'required',
        ]);
        $contactId = $this->storeContact($request);
        $addressId = $this->storeAddress($request);
        $shipper = new Shipper();
        $shipper->first_name = $request->first_name;
        $shipper->last_name = $request->last_name;
        $shipper->address_id = $addressId;
        $shipper->contact_id = $contactId;
        $shipper->user_id = JWTAuth::user()->id;
        $shipper->save();
        return response()->json(["message" => "Saved successfully!"], 200);
    }

    public function storeContact($request){
        $contact = new Contact();
        $contact->name = $request->last_name;
        $contact->phone = $request->phone;
        $contact->email = JWTAuth::user()->email;
        $contact->save();
        return $contact->id;
    }
    public function storeAddress($request){
        $address = new Address();
        $address->country_id = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->zip = $request->zip;
        $address->formated_address = $request->address;
        $address->save();
        return $address->id;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\shipper  $shipper
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carrier = Shipper::with('fullAddress','contact')->find($id);
        return $carrier;
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'address' => 'required',
        ]);
        $contactId = $this->updateContact($request);
        $addressId = $this->updateAddress($request);
        $shipper = Shipper::find($id);

        $shipper->first_name = $request->first_name;
        $shipper->last_name = $request->last_name;
        $shipper->address_id = $addressId;
        $shipper->contact_id = $contactId;
        $shipper->user_id = JWTAuth::user()->id;
        $shipper->update();

        return response()->json(["message" => "Updated successfully!x"], 200);
    }

    public function updateContact($request){
        $contact = Contact::find($request->contactId);
        $contact->name = $request->last_name;
        $contact->phone = $request->phone;
        $contact->email = JWTAuth::user()->email;
        $contact->update();
        return $contact->id;
    }
    public function updateAddress($request){
        $address = Address::find($request->addressId);
        $address->country_id = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->zip = $request->zip;
        $address->address = $request->address;
        $address->update();
        return $address->id;
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
