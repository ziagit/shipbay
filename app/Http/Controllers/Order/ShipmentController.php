<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Shipper;
use App\Item;
use App\Order;
use App\Accessory;
use App\Carrier;
use App\Job;
use App\Notifications\JobCreated;
use App\Address;
use App\Contact;
use App\Country;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function React\Promise\Stream\first;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $shipperId = $this->storeShipper($request->shipper);

        if ($shipperId) {
            $orderId = $this->storeOrder($request, $shipperId);
            
            $job = $this->createNewJob($orderId, $shipperId, $request->carrier);

            $user  = Carrier::with('user')->find($request->carrier['id'])->user;

            $admin = User::find(1);

            //$notificatied = $user->notify(new JobCreated($job));

            //$notificatied=$admin->notify(new JobCreated($job));
            //return response()->json($notificatied);

            return response()->json("successfull");
        }
        return response()->json(['message' => 'Shipper not found!'], 404);
    }
    public function storeOrder($request, $shipperId)
    {
        $contactIds = $this->storeContact($request);
        $addressIds = $this->storeAddress($request);
    
        $order = Order::where('uniqid', $request->id)->first();
        $order->pickup_date = $request->pickDate;
        $order->src_appointment_time = $request->src['appointmentTime'];
        $order->des_appointment_time = $request->des['appointmentTime'];
        $order->min_temperature = $request->myItem['minTemp'];
        $order->max_temperature = $request->myItem['maxTemp'];
        $order->cost = $request->carrier['price'];
        $order->estimated_value = $request->shipper['estimatedValue'];
        $order->instructions = $request->shipper['instructions'];

        $order->shipper_id = $shipperId;

        $order->update();
        $itemId = $this->storeItem($request);
        $order->items()->attach($itemId);

        $order->contacts()->attach($contactIds);
        $order->addresses()->attach($addressIds);
        
        foreach ($request->src['accessories'] as $accessory) {
            if (!empty($accessory)) {
                $src_accessory = Accessory::where('code', $accessory)->get();
                $order->accessories()->attach($src_accessory[0]->id, ['type' => 'src']);
            }
        }
        foreach ($request->des['accessories'] as $accessory) {
            if (!empty($accessory)) {
                $des_accessory = Accessory::where('code', $accessory)->get();
                $order->accessories()->attach($des_accessory[0]->id, ['type' => 'des']);
            }
        }
        foreach ($request->myItem['conditions'] as $accessory) {
            if (!empty($accessory)) {
                $gen_accessory = Accessory::where('code', $accessory)->get();
                $order->accessories()->attach($gen_accessory[0]->id, ['type' => 'gen']);
            }
        }
        return $order->id;
    }
    public function storeItem($request){
        $items = $request->myItem['items'];
        $data = array();
        $itemId = array();
        foreach ($items as $item) {
            if (!empty($item)) {
                $data = [
                    'description' => $item['description'],
                    'dimentional_weight' => $this->calculateDW($item),
                    'itemtype_id' => $item['type'],
                    'deliveryclass_id' => 1
                ];
            }
            $id = Item::insertGetId($data);
            array_push($itemId, $id);
        }
        return $itemId;
    }

    public function storeContact($request){
        $contactIds = array();
        $srcContact = [
            'name' => $request->shipper['pickupName'],
            'phone' => $request->shipper['pickupPhone'],
            'email' => $request->shipper['pickupEmail']
        ];
        $srcId = Contact::insertGetId($srcContact);
        array_push($contactIds, $srcId);

        $desContact = [
            'name' => $request->shipper['deliveryName'],
            'phone' => $request->shipper['deliveryPhone'],
            'email' => $request->shipper['deliveryEmail']
        ];
        $desId = Contact::insertGetId($desContact);
        array_push($contactIds, $desId);
        return $contactIds;
    }
    public function storeAddress($request){
        $addressIds = array();
        $srcCountry = Country::where('name', $request->src['country'])->first();
        $srcAddress = [
            'street' => $request->src['street'],
            'street_number' => $request->src['street_number'],
            'zip' => $request->src['zip'],
            'city' => $request->src['city'],
            'state' => $request->src['state'],
            'country_id' => $srcCountry->id
        ];
        $srcId = Address::insertGetId($srcAddress);
        array_push($addressIds, $srcId);

        $desCountry = Country::where('name', $request->des['country'])->first();
        $desAddress = [
            'street' => $request->des['street'],
            'street_number' => $request->des['street_number'],
            'zip' => $request->des['zip'],
            'city' => $request->des['city'],
            'state' => $request->des['state'],
            'country_id' => $desCountry->id
        ];
        $desId = Address::insertGetId($desAddress);
        array_push($addressIds, $desId);
        return $addressIds;
    }

    public function storeShipper($data)
    {
        if (Auth::check() && auth()->user()->roles[0]->name === "shipper") {
            $shipper = User::with('shipper')->find(Auth::id())->shipper;
            if ($shipper) {
                return $shipper->id;
            }
            return false;
        }

        $shipper = new Shipper();
        $shipper->first_name = $data['pickupName'];
        $shipper->save();

        return $shipper->id;
    }

    public function createNewJob($order, $shipperId, $carrier)
    {
        $job = new Job();
        $job->order_id = $order;
        $job->shipper_id = $shipperId;
        $job->carrier_id = $carrier['id'];
        $job->save();
        return $job;
    }

    public function calculateDW($item)
    {
        $x = (($item['width'] * $item['height'] * $item['length']) / 166) * $item['number'];
        $y = $item['weight'] * $item['number'];
        $dw = $x >= $y ? $x : $y;
        return round($dw);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::with('orderDetail', 'jobstatus')->find($id);
        return $job;
    }
    public function carrierContacts($id)
    {
        $carrier = Carrier::with('contact')->find($id);
        return $carrier;
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
}
