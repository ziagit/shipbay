<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\State;
use App\Country;

class AdminStateController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::with('country')->paginate(5);
        return response()->json($states);
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
            'name' => 'required',
            'country' => 'required'
        ]);
        $state = new State();

        $state->name = $request->name;
        $state->country_id = $request->country;

        $state->save();
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
            'name' => 'required',
            'country' => 'required'
        ]);
        $state = State::find($id);

        $state->name = $request->name;
        $state->country_id = $request->country;

        $state->save();
        return response()->json(["message" => "Saved Successfully."], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($state = State::find($id)) {
            $state->delete();
            return response()->json(["message" => "Deleted Successfully."], 200);
        }
        return response()->json(["message" => "Data Not Found!"], 404);
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $state = State::where('name', 'like', '%' . $keywords . '%')
            ->orWhereHas('country', function ($q) use ($keywords) {
                return $q->where('name', 'like', '%' . $keywords . '%');
            })
            ->with('country')
            ->paginate(5);
        return $state;
    }
}
