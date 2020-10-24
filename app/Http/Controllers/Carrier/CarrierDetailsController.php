<?php

namespace App\Http\Controllers\Carrier;

use App\Http\Controllers\Controller;
use App\Carrier;
use App\Contact;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

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
        $carrier = Carrier::with('fullAddress','contact')->where('user_id', $userId)->first();
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
            'addressId' => 'required',
        ]);
        $contactId = $this->storeContact($request);
        try {
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $logo_name = time() . '.' . $file->getClientOriginalName();
                $file->move(public_path('images/uploads'), $logo_name);
            } else {
                $logo_name = "undefined";
            }
        } catch (Exception $e) {
            die('File did not upload: ' . $e->getMessage());
        }

        $carrier = new Carrier();
        $carrier->first_name = $request->first_name;
        $carrier->last_name = $request->last_name;
        $carrier->website = $request->website;
        $carrier->company = $request->company;
        $carrier->detail = $request->detail;
        $carrier->logo = $logo_name;
        $carrier->address_id = $request->addressId;
        $carrier->contact_id = $contactId;
        $carrier->user_id = JWTAuth::user()->id;

        $carrier->save();
        
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
    /**
     * Display the specified resource.
     *
     * @param  \App\carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carrier = Carrier::with('fullAddress','contact')->find($id);
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
            'addressId' => 'required',
        ]);
        $contactId = $this->updateContact($request);
        $carrier = Carrier::find($id);

            if ($request->hasFile('logo')) {

                $old_image_path = public_path('images/uploads/' . $carrier->logo);
                if (file_exists($old_image_path)) {
                    @unlink($old_image_path);
                }
                $file = $request->file('logo');
                $logo_name = time() . '.' . $file->getClientOriginalName();
                $file->move(public_path('images/uploads'), $logo_name);
            } else {
                $logo_name = $carrier->logo;
            }
      

        $carrier->first_name = $request->first_name;
        $carrier->last_name = $request->last_name;
        $carrier->website = $request->website;
        $carrier->company = $request->company;
        $carrier->detail = $request->detail;
        $carrier->logo = $logo_name;
        $carrier->address_id = $request->addressId;
        $carrier->contact_id = $contactId;
        $carrier->user_id = JWTAuth::user()->id;
        $carrier->update();

        return response()->json(["message" => "Updated successfully!"], 200);
    }

    public function updateContact($request){
        $contact = Contact::find($request->contactId);
        $contact->name = $request->last_name;
        $contact->phone = $request->phone;
        $contact->email = JWTAuth::user()->email;
        $contact->update();
        return $contact->id;
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
