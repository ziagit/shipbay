<?php

namespace App\Http\Controllers;

use App\order;
use App\City;
use App\Citycode;
use App\Accessory;
use App\Item;
use App\Itemtype;
use Illuminate\Http\Request;
use OrderSeeder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //saving item
        $items = $request->myItem['items'];
        $data = array();
        $itemId = array();
        foreach ($items as $item) {
            if (!empty($item)) {
                $data = [
                    'description' => $item['description'],
                    'dimentional_weight' => $item['dw'],
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
        $order->cost = 1500;

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
            if(!empty($accessory)){
                $src_accessory = Accessory::where('code', $accessory)->get();
                $order->accessories()->attach($src_accessory[0]->id, ['type'=>'src']);
            }
        }
        foreach ($request->des['accessories'] as $accessory) {
            if(!empty($accessory)){
                $des_accessory = Accessory::where('code', $accessory)->get();
                $order->accessories()->attach($des_accessory[0]->id, ['type'=>'des']);
            }
        }
        foreach ($request->myItem['conditions'] as $accessory) {
            if(!empty($accessory)){
                $gen_accessory = Accessory::where('code', $accessory)->get();
                $order->accessories()->attach($gen_accessory[0]->id, ['type'=>'gen']);
            }
        }

        return $order->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('items')->find($id);
        return $order;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $citycodes = Citycode::where('postal_code', 'like', '%' . $keywords . '%')
            ->orWhereHas('cities', function ($q) use ($keywords) {
                return $q->where('name', 'like', '%' . $keywords . '%');
            })
            ->with('cities')
            ->paginate(5);
        return $citycodes;
    }

    public function locationType()
    {
        $cities = City::all();
        $services = Accessory::where('code', 'bs')->orWhere('code', 'rs')->orWhere('code', 'sp')->get();
        return compact('cities', 'services');
    }
    public function pickServices()
    {
        $services = Accessory::where('code', 'tl')->orWhere('code', 'in')->get();
        return $services;
    }
    public function deliveryServices()
    {
        $services = Accessory::where('code', 'tl')->orWhere('code', 'in')->orWhere('code', 'ap')->get();
        return $services;
    }
    public function pickDate()
    {
        $appointment = Accessory::where('code', 'ap')->get();
        return $appointment;
    }
    public function itemCondition()
    {
        $appointment = Accessory::where('code', 'tm')->orWhere('code', 'dg')->orWhere('code', 'st')->get();
        return $appointment;
    }
    public function itemType()
    {
        $types = Itemtype::all();
        return $types;
    }
}
