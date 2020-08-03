<?php

namespace App\Http\Controllers;

use App\Job;
use App\Jobstatus;
use App\Notifications\JobUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class JobController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $jobs = Job::with('cityZip', 'jobstatus')->where('carrier_id', $id)->get();
        return $jobs;
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
        $jobs = Job::with('shipper', 'jobstatus')->find($id);
        return $jobs;
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
        
  /*       $job = Job::find($id);
        $job->jobstatus_id = $request->status;
        $job->update(); */
        $notified = $this->notifyShipper($id);
     
        return $notified;
    }
    public function notifyShipper($id){
        $job = Job::with('shipper', 'jobstatus')->find($id);
        $test = $job->shipper->addresses->src_des;
        $test = json_decode($test);

        if (!is_array($test)) {

            return 'not array';
        }else{
            return 'array';
        }
        return $job->shipper->addresses->src_des[1]['email'];
        Notification::route('mail',$job->shipper->src_des[1]['email'])
        ->notify(new JobUpdated($job));
        return $job;
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
    public function jobStatus()
    {
        return Jobstatus::all();
    }
}
