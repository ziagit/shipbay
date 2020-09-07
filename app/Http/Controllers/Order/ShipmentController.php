<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Address;
use App\Shipper;
use App\Item;
use App\Order;
use App\Accessory;
use App\Carrier;
use App\Job;
use App\Notifications\JobCreated;
use App\Shipmentaddress;
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
        $addressId = $this->storeAddress($request);

        $shipperId = $this->storeShipper($request->shipper);

        if ($shipperId) {
            $orderId = $this->storeOrderItem($request, $shipperId, $addressId);

            $job = $this->createNewJob($orderId, $addressId, $shipperId, $request->carrier);

            $user  = Carrier::with('user')->find($request->carrier['id'])->user;
            $admin = User::find(1);
            $user->notify(new JobCreated($job));
            $admin->notify(new JobCreated($job));

            return $user->notifications;
        }
        return response()->json(['message' => 'Shipper not found!'], 404);
    }
    public function storeOrderItem($request, $shipperId, $addressId)
    {
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

        //saving order
        $order = Order::where('uniqid', $request->id)->first();
        $order->pickup_date = $request->pickDate;
        $order->src_appointment_time = $request->src['appointmentTime'];
        $order->des_appointment_time = $request->des['appointmentTime'];
        $order->min_temperature = $request->myItem['minTemp'];
        $order->max_temperature = $request->myItem['maxTemp'];
        $order->cost = $request->carrier['price'];
        $order->estimated_value = $request->shipper['estimatedValue'];
        $order->start_loadtime = $request->shipper['startLoadTime'];
        $order->end_loadtime = $request->shipper['endLoadTime'];
        $order->shipper_id = $shipperId;

        $order->update();

        $order->items()->attach($itemId);

        $src_address = Shipmentaddress::find($addressId[0]);
        $order->shipmentaddresses()->attach($src_address, ['type' => 'src']);

        $des_address = Shipmentaddress::find($addressId[1]);
        $order->shipmentaddresses()->attach($des_address, ['type' => 'des']);

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

    public function storeAddress($request)
    {
        $addressId = array();
        $srcAddress = [
            'company' => $request->shipper['pickDetails']['company'],
            'address' => $request->shipper['pickDetails']['address'],
            'refrence' => $request->shipper['pickDetails']['refrenceNumber'],
            'instructions' => $request->shipper['pickDetails']['instructions'],
            'name' => $request->shipper['pickDetails']['name'],
            'phone' => $request->shipper['pickDetails']['phone'],
            'email' => $request->shipper['pickDetails']['email'],
            'country_id' => $request->src['country'],
            'state_id' => $request->shipper['pickDetails']['state'],
            'city_id' => $request->shipper['pickDetails']['city'],
            'citycode_id' => $request->shipper['pickDetails']['postalCode'],
        ];
        $srcId = Shipmentaddress::insertGetId($srcAddress);
        array_push($addressId, $srcId);

        $desAddress = [
            'company' => $request->shipper['deliveryDetails']['company'],
            'address' => $request->shipper['deliveryDetails']['address'],
            'refrence' => $request->shipper['deliveryDetails']['refrenceNumber'],
            'instructions' => $request->shipper['deliveryDetails']['instructions'],
            'name' => $request->shipper['deliveryDetails']['name'],
            'phone' => $request->shipper['deliveryDetails']['phone'],
            'email' => $request->shipper['deliveryDetails']['email'],
            'country_id' => $request->des['country'],
            'state_id' => $request->shipper['deliveryDetails']['state'],
            'city_id' => $request->shipper['deliveryDetails']['city'],
            'citycode_id' => $request->shipper['deliveryDetails']['postalCode'],
        ];
        $desId = Shipmentaddress::insertGetId($desAddress);
        array_push($addressId, $desId);
        return $addressId;
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
        $shipper->first_name = $shipperData['pickDetails']['company'];
        $shipper->save();

        return $shipper->id;
    }

    public function createNewJob($order, $address, $shipperId, $carrier)
    {
        $job = new Job();
        $job->order_id = $order;
        $job->src_address_id = $address[0];
        $job->des_address_id = $address[1];
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
        $job = Job::with('shipment', 'jobstatus')->find($id);
        return $job;
    }
    public function carrierContacts($id)
    {
        $carrier = Carrier::find($id);
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
