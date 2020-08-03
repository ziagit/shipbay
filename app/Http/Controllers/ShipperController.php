<?php

namespace App\Http\Controllers;

use App\Address;
use App\Shipper;
use App\Item;
use App\Order;
use App\Citycode;
use App\Accessory;
use App\Carrier;
use App\Job;
use App\Notifications\JobCreated;

use Illuminate\Http\Request;

class ShipperController extends Controller
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
        $shipperId = $this->storeShipper($request->shipper, $addressId);
        $orderId = $this->storeOrderItem($request, $shipperId);

        $job = $this->createNewJob($orderId, $addressId, $shipperId, $request->carrier);

        $user  = Carrier::with('user')->find($request->carrier['id'])->user;

        $user->notify(new JobCreated($job));
        return $user->notifications;

    }
    public function storeOrderItem($request, $shipperId)
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
        $order = new Order();
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

        $order->save();

        //attaching item to order
        $order->items()->attach($itemId);

        //attaching city and city zip code to order

        $src_code = Citycode::find($request->src['postalCode']);
        $order->citycodes()->attach($src_code, ['type' => 'src']);

        $des_code = Citycode::find($request->des['postalCode']);
        $order->citycodes()->attach($des_code, ['type' => 'des']);

        //attaching accessories to order
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
            'city_id' => $request->shipper['pickDetails']['city'],
            'citycode_id' => $request->shipper['pickDetails']['postalCode'],
        ];
        $srcId = Address::insertGetId($srcAddress);
        array_push($addressId, $srcId);

        $desAddress = [
            'company' => $request->shipper['deliveryDetails']['company'],
            'address' => $request->shipper['deliveryDetails']['address'],
            'refrence' => $request->shipper['deliveryDetails']['refrenceNumber'],
            'instructions' => $request->shipper['deliveryDetails']['instructions'],
            'name' => $request->shipper['deliveryDetails']['name'],
            'phone' => $request->shipper['deliveryDetails']['phone'],
            'email' => $request->shipper['deliveryDetails']['email'],
            'city_id' => $request->shipper['deliveryDetails']['city'],
            'citycode_id' => $request->shipper['deliveryDetails']['postalCode'],
        ];
        $desId = Address::insertGetId($desAddress);
        array_push($addressId, $desId);
        return $addressId;
    }
    public function storeShipper($shipperData, $addressId)
    {
        $shipper = new Shipper();
        $shipper->name = $shipperData['deliveryDetails']['company'];
        $shipper->save();

        $src_address = Address::find($addressId[0]);
        $shipper->addresses()->attach($src_address, ['type'=>'src']);
        
        $des_address = Address::find($addressId[1]);
        $shipper->addresses()->attach($des_address, ['type'=>'des']);
        return $shipper->id;
    }
    public function calculateDW($item)
    {
        $x = (($item['width'] * $item['height'] * $item['length']) / 166) * $item['number'];
        $y = $item['weight'] * $item['number'];
        $dw = $x >= $y ? $x : $y;
        return round($dw);
    }
    public function createNewJob($order, $address, $shipperId, $carrier){
        $job = new Job();
        $job->order_id = $order;
        $job->src_address_id = $address[0];
        $job->des_address_id = $address[1];
        $job->shipper_id =$shipperId;
        $job->carrier_id = $carrier['id'];
        $job->save();
        return $job;
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
