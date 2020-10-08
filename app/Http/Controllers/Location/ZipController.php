<?php

namespace App\Http\Controllers\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Citycode;
use App\City;
class ZipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citycodes = Citycode::with('cities')->get();
        return $citycodes;
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
        $citycodes = City::with('citycodes')->find($id);
        return $citycodes;   
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
        //
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
    public function all(){
        return Citycode::all();
    }
    public function search(Request $request, $id)
    {
        $keywords = $request->keywords;
        $results = Citycode::where('address_id',$id)
        ->where('postal_code', 'like', '%' . $keywords . '%')
        ->paginate(5);
        return $results;
    }
}
