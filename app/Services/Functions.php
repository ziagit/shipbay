<?php

namespace App\Services;

use App\Carrier;
use App\Raterange;

class Functions
{
    public function calculateCost($request)
    {
    
        //find total dimentional_weight & source & destination cities in order table
        $selectedCarriers = array();
        $i = 0;
        $ranges = Raterange::all();
        
        $order_src = $request->src['city'];
        $order_des = $request->des['city'];

        $dimentional_weight = $this->calcDW($request->myItem['items']) ;
        // search src & des zips in rate table

        $carriers = Carrier::with('rateaddress', 'accessories','contact')->get();
// if you get error 'must be of the type string or null, object given laravel'; there is a precedency problem.
//change function name in your Model. in above case rateaddress if you change to rateAddress u would get error.

        /* if (!is_array($carriers)) {
            $carriers = json_decode($carriers);
        } */
        foreach ($carriers as $carrier) {
        
            foreach ($carrier->rateaddress as $rate) {
                $rate_src = $rate->addresses[0]->city;
                $rate_des = $rate->addresses[1]->city;
                $carrier_accessories = $carrier->accessories;
                $cost = 0;
                if (($rate_src === $order_src) && ($rate_des === $order_des)) {
                    switch ($dimentional_weight) {
                        case ($dimentional_weight > 0 && $dimentional_weight <= $ranges[0]['value']):
                            $cost = $this->costCalc($dimentional_weight, $rate->_0k_1k, $rate);
                            break;
                        case ($dimentional_weight > $ranges[0]['value'] && $dimentional_weight <= $ranges[1]['value']):
                            $cost = $this->costCalc($dimentional_weight, $rate->_1k_2k, $rate);
                            break;
                        case ($dimentional_weight > $ranges[1]['value'] && $dimentional_weight <= $ranges[2]['value']):
                            $cost = $this->costCalc($dimentional_weight, $rate->_2k_3k, $rate);
                            break;
                        case ($dimentional_weight > $ranges[2]['value'] && $dimentional_weight <= $ranges[3]['value']):
                            $cost = $this->costCalc($dimentional_weight, $rate->_3k_4k, $rate);
                            break;
                        case ($dimentional_weight > $ranges[3]['value'] && $dimentional_weight <= $ranges[4]['value']):
                            $cost = $this->costCalc($dimentional_weight, $rate->_4k_5k, $rate);
                            break;
                        case ($dimentional_weight > $ranges[4]['value'] && $dimentional_weight <= $ranges[5]['value']):
                            $cost = $this->costCalc($dimentional_weight, $rate->_5k_10k, $rate);
                            break;
                        case ($dimentional_weight > $ranges[5]['value']):
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
                    $selectedCarriers[$i]['phone'] = $carrier->contact->phone;
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
        return $cost < $rate->min_rate ? $rate->min_rate : $cost;
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
}
