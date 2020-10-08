<?php

namespace App\Http\Controllers\Location;
use App\Http\Controllers\Controller;
use App\City;
use App\Citycode;
use App\State;
use Illuminate\Http\Request;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return City::all();
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
     * @param  \App\city  $city
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cities = City::where('state_id', $id)->get();
        
        return $cities;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\city  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(city $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\city  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, city $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\city  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(city $city)
    {
        //
    }

    public function search(Request $request, $id)
    {
        $keywords = $request->keywords;
        $cities = City::where('state_id', $id)
        ->where('name', 'like', '%' . $keywords . '%')
        ->paginate(5);
        return $cities;
    }
    public function searchCityState(Request $request, $id)
    {
        $keywords = $request->keywords;
        $citycodes = City::where('name', 'like', '%' . $keywords . '%')
            ->orWhereHas('state', function ($q) use ($keywords, $id) {
                $q->where('name', 'like', '%' . $keywords . '%');
            })
            ->with('state')
            ->paginate(5);
        return $citycodes;
    }

}
