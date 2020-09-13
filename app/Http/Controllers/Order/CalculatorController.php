<?php

namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Carrier;
use App\Notifications\CarrierBooked;
use App\User;

class CalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carriers = Carrier::with('cityRate')->get();
        return $carriers;
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

    public function calculator(Request $request)
    {
        //find total dimentional_weight & source & destination cities in order table
        $selectedCarriers = array();
        $i = 0;

        $order_src = $request->src['postalCode'];
        $order_des = $request->des['postalCode'];
        $dimentional_weight = $this->calcDW($request->myItem['items']);
        // search src & des zips in rate table
        $carriers = Carrier::with('carrierRates', 'accessories')->get();
        if (!is_array($carriers)) {
            $carriers = json_decode($carriers);
        }
        foreach ($carriers as $carrier) {
            foreach ($carrier->carrier_rates as $rate) {
                $rate_src = $rate->rate_citycode[0]->id;
                $rate_des = $rate->rate_citycode[1]->id;
                $carrier_accessories = $carrier->accessories;
                $cost = 0;
                if (($order_src == $rate_src) && ($order_des == $rate_des)) {
                    switch ($dimentional_weight) {
                        case ($dimentional_weight > 0 && $dimentional_weight <= 1000):
                            $cost = $this->costCalc($dimentional_weight, $rate->_0k_1k, $rate);
                            break;
                        case ($dimentional_weight > 1000 && $dimentional_weight <= 2000):
                            $cost = $this->costCalc($dimentional_weight, $rate->_1k_2k, $rate);
                            break;
                        case ($dimentional_weight > 2000 && $dimentional_weight <= 3000):
                            $cost = $this->costCalc($dimentional_weight, $rate->_2k_3k, $rate);
                            break;
                        case ($dimentional_weight > 3000 && $dimentional_weight <= 4000):
                            $cost = $this->costCalc($dimentional_weight, $rate->_3k_4k, $rate);
                            break;
                        case ($dimentional_weight > 4000 && $dimentional_weight <= 5000):
                            $cost = $this->costCalc($dimentional_weight, $rate->_4k_5k, $rate);
                            break;
                        case ($dimentional_weight > 5000 && $dimentional_weight <= 10000):
                            $cost = $this->costCalc($dimentional_weight, $rate->_5k_10k, $rate);
                            break;
                        case ($dimentional_weight > 10000):
                            $cost = $this->costCalc($dimentional_weight, $rate->above_10k, $rate);
                            break;
                        default:
                            echo 'not found your weight ';
                    }

                    $a_value = $this->accessoryCalc($request, $carrier_accessories);

                    $cost = $cost + $a_value;
                    $service_charge = ($cost * 10) / 100;
                    $cost = $cost + $service_charge;
                    $selectedCarriers[$i]['id'] = $carrier->id;
                    $selectedCarriers[$i]['first_name'] = $carrier->first_name;
                    $selectedCarriers[$i]['last_name'] = $carrier->last_name;
                    $selectedCarriers[$i]['company'] = $carrier->company;
                    $selectedCarriers[$i]['detail'] = $carrier->detail;
                    $selectedCarriers[$i]['phone'] = $carrier->phone;
                    $selectedCarriers[$i]['website'] = $carrier->website;
                    $selectedCarriers[$i]['logo'] = $carrier->logo;
                    $selectedCarriers[$i]['price'] = $cost;
                    $i++;
                } else {
                    /* return ' carrier not found for this range'; */
                }
            }
        }

        return response()->json($selectedCarriers);
    }

    public function costCalc($dimentional_weight, $matchedRate, $rate)
    {
        $cost = ($dimentional_weight / 100) * $matchedRate;
        $percentage = ($cost * $rate->fsc) / 100;
        $cost = $cost + $percentage;
        if ($cost < $rate->min_rate) {
            $cost = $rate->min_rate;
        }
        return $cost;
    }
    public function accessoryCalc($request, $carrier_accessories)
    {
        $src_accessories =  $request->src['accessories'];
        $des_accessories =  $request->des['accessories'];
        $item_conditions =  $request->myItem['conditions'];

        $a_costs = 0;
        foreach ($carrier_accessories as $c_a) {
            foreach ($src_accessories as $ac) {
                if ($ac == $c_a->code) {
                    $a_costs = $a_costs + $c_a->pivot->src_value;
                }
            }
        }
        foreach ($carrier_accessories as $c_a) {
            foreach ($des_accessories as $ac) {
                if ($ac == $c_a->code) {
                    $a_costs = $a_costs + $c_a->pivot->src_value;
                }
            }
        }
        foreach ($carrier_accessories as $c_a) {
            foreach ($item_conditions as $ac) {
                if ($ac == $c_a->code) {
                    $a_costs = $a_costs + $c_a->pivot->des_value;
                }
            }
        }
        return $a_costs;
    }
    public function calcDW($items)
    {
        $dw = 0;
        foreach ($items as $item) {
            $x = (($item['width'] * $item['height'] * $item['length']) / 166) * $item['number'];
            $y = $item['weight'] * $item['number'];
            $dw = $dw + ($x >= $y ? $x : $y);
        }

        return $dw;
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
    public function test()
    {
        $shipper=[
            'name'=>'zia',
            'website' => 'coffeequery.com'
        ];
        $user = User::find(1);
        $this->notify(new \App\Notifications\JobCreated($shipper));
        return 'ok';
        
    }
}
