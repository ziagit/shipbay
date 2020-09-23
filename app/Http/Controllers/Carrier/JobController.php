<?php

namespace App\Http\Controllers\Carrier;
use App\Http\Controllers\Controller;
use App\Job;
use App\Jobstatus;
use App\Notifications\JobUpdated;
use App\Notifications\UserJobUpdated;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function index()
    {
        $carrierId = User::with('shipper')->find(Auth::id())->carrier->id;

        $jobs = Job::with('shipment', 'jobstatus')->where('carrier_id', $carrierId)->orderBy('id','DESC')->get();
        return response()->json($jobs);
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
        $jobs = Job::with('shipment', 'jobstatus')->find($id);
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
        $job = Job::find($id);
        $job->jobstatus_id = $request->status;
        $job->update();
        if ($request->emails[0] !== $request->emails[1]) {
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
        return $this->notifyShipper($request->emails, $id);
    }

    public function notifyUser($user, $id)
    {
        $job = Job::with('shipment', 'jobstatus')->find($id);

        $user->notify(new UserJobUpdated($job));
        return $job;
    }

    public function notifyShipper($emails, $id)
    {
        $job = Job::with('shipment', 'jobstatus')->find($id);

        if ($emails[0] !== $emails[1]) {
            foreach ($emails as $email) {
                Notification::route('mail', $email)
                    ->notify(new JobUpdated($job));
            }
        } else {
            Notification::route('mail', $emails[0])
                ->notify(new JobUpdated($job));
        }
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
        return Jobstatus::where('id' ,'<>', 6)->get();
    }
}
