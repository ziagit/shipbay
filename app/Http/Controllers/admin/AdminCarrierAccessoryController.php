<?php

namespace App\Http\Controllers\Admin;

use App\Accessory;
use App\Carrier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCarrierAccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carriers = Carrier::with('accessories')->paginate(2);
        $myArray = array();
        $count = 0;
        foreach($carriers as $carrier){
            foreach($carrier->accessories as $accessory){
                array_push($myArray, $accessory);
                $myArray[$count]['carrier']=$carrier->first_name;
                $count++;
            }
        }
        return $myArray;

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
        $accessory = Accessory::find($id);
        $newAccessory = Accessory::find($request->name);
        $carrier= Carrier::find($request->carrierId);

        $carrier->accessories()->detach($accessory);
        $carrier->accessories()->attach($newAccessory, ['src_value' => $request->srcValue, 'des_value' => $request->desValue]);
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
    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $citycodes = Carrier::where('first_name', 'like', '%' . $keywords . '%')
            ->orWhereHas('accessories', function ($q) use ($keywords) {
                return $q->where('name', 'like', '%' . $keywords . '%');
            })
            ->with('accessories')
            ->paginate(9);
        return $citycodes;
    }
}
