<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Citycode;
class AdminZipController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zips = Citycode::with('address')->paginate(10);
        return response()->json($zips);
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
            'postalcode' => 'required',
            'address'=>'required'
        ]);
        $zip = new Citycode();
        $zip->postal_code = $request->postalcode;
        $zip->address_id = $request->address;
        $zip->save();
        return response()->json(["message" => "Saved Successfully."], 200);
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
        $this->validate($request, [
            'postalcode' => 'required',
            'address' => 'required'
        ]);
        $zip = Citycode::find($id);
        $zip->postal_code = $request->postalcode;
        $zip->address_id = $request->address;
        $zip->update();

        return response()->json(["message" => "Updated Successfully."], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($zip = Citycode::find($id)) {
            $zip->delete();
            return response()->json(["message" => "Deleted Successfully."], 200);
        }
        return response()->json(["message" => "Data Not Found!"], 404);
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $citycodes = Citycode::where('postal_code', 'like', '%' . $keywords . '%')
            ->orWhereHas('address', function ($q) use ($keywords) {
                return $q->where('name', 'like', '%' . $keywords . '%');
            })
            ->with('address')
            ->paginate(10);
        return $citycodes;
    }
}
