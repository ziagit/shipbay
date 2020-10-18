<?php

namespace App\Http\Controllers\Admin;

use App\Carrier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCarrierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carriers = Carrier::paginate(10);
        return response()->json($carriers);
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
        $carrier->update();

        return response()->json(["message" => "Updated successfully!"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carrier = Carrier::find($id);
        $carrier->delete();
        return response()->json(["message"=>"Deleted successfully!"],200);
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $carrier = Carrier::where('first_name', 'like', '%' . $keywords . '%')
            ->paginate(10);
        return $carrier;
    }
}
