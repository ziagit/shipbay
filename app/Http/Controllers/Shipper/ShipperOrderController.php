<?php

namespace App\Http\Controllers\Shipper;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Job;
use App\Jobstatus;
use App\Order;
use Illuminate\Http\Request;
use App\User;

class ShipperOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /*   $user = User::with('shipper')->find(Auth::id())->shipper->id;
        return $user; */
        $shipperId = User::with('shipper')->find(Auth::id())->shipper->id;
        return Order::with('fullAddress','jobWithStatus')->where('shipper_id',$shipperId)->orderBy('id','DESC')->get();
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
        return Order::with('fullAddress','items','jobWithStatus')->find($id);
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
        $job = Job::find($request->jobId);
        $job->jobstatus_id = Jobstatus::all()->last()->id;
        $job->update();

        return Order::with('fullAddress','items','jobWithStatus')->find($id);
/*         if ($request->emails[0] !== $request->emails[1]) {
            foreach ($request->emails as $email) {
                $user = User::where('email', $email)->first();
                if ($user) {
                    return $this->notifyUser($user, $id);
                }
            }
        } else {
            $user = User::where('email', $request->emails[0])->first();
            if ($user) {
                return $this->notifyUser($user, $id);
            }
        }
        return $this->notifyShipper($request->emails, $id); */
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
    public function status(){
        return Jobstatus::all()->last();
    }
}
