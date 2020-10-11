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
use App\Customeraddress;
use App\Contact;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $user->notify(new JobCreated($job));
            $admin->notify(new JobCreated($job));

            return $user->notifications;
        }
        return response()->json(['message' => 'Shipper not found!'], 404);
    }
    public function storeOrder($request, $shipperId)
    {
        $contactId = $this->storeContact($request);
        $addressId = $this->storeAddress($request);
        
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

        $order->contacts()->attach($contactId);
        $order->addresses()->attach($addressId);
        
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
    public function storeAddress($request)
    {
        $addressId = array();
        $srcAddress = [
            'country_id' => $request->src['country'],
            'state_id' => $request->src['state'],
            'city_id' => $request->src['city'],
            'zip_id' => $request->src['postalCode'],
            'address_id' => $request->src['address'],
        ];
        $srcId = Customeraddress::insertGetId($srcAddress);
        array_push($addressId, $srcId);

        $desAddress = [
            'country_id' => $request->des['country'],
            'state_id' => $request->des['state'],
            'city_id' => $request->des['city'],
            'zip_id' => $request->des['postalCode'],
            'address_id' => $request->des['address'],
        ];
        $desId = Customeraddress::insertGetId($desAddress);
        array_push($addressId, $desId);
        return $addressId;
    }
    public function storeContact($request){
        $contactId = array();
        $srcContact = [
            'name' => $request->shipper['pickupName'],
            'phone' => $request->shipper['pickupPhone'],
            'email' => $request->shipper['pickupEmail']
        ];
        $srcId = Contact::insertGetId($srcContact);
        array_push($contactId, $srcId);

        $desContact = [
            'name' => $request->shipper['deliveryName'],
            'phone' => $request->shipper['deliveryPhone'],
            'email' => $request->shipper['deliveryEmail']
        ];
        $desId = Contact::insertGetId($desContact);
        array_push($contactId, $desId);
        return $contactId;
    }

    public function storeShipper($shipperData)
    {
        if (Auth::check()) {
            $shipper = User::with('shipper')->find(Auth::id())->shipper;
            if ($shipper) {
                return $shipper->id;
            }
            return false;
        }

        $shipper = new Shipper();
        $shipper->first_name = $shipperData['pickupName'];
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
