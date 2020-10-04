<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Raterange;
use Illuminate\Http\Request;

class AdminRaterangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ranges = Raterange::paginate(10);
        return response()->json($ranges);
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
            'value' => 'required|unique:rateranges',
        ]);
        $range = new Raterange();

        $range->name = $request->name;
        $range->value = $request->value;

        $range->save();
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
            'value' =>'required|unique:rateranges'
        ]);
        $range = Raterange::find($id);

        $range->name = $request->name;
        $range->value = $request->value;

        $range->update();
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
        $range = Raterange::find($id);
        $range->delete();
        return response()->json(['message'=>'Deleted successfully!'],200);
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $range = Raterange::where('name', 'like', '%' . $keywords . '%')
            ->paginate(10);
        return $range;
    }
}
