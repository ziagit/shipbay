<?php

use App\Accessory;
use App\Address;
use App\Citycode;
use Illuminate\Database\Seeder;
use App\Order;
use App\Item;
use App\City;
use App\Shipmentaddress;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::truncate();
        $order = new Order();
     
        $order->pickup_date = '2020-09-06';
        $order->src_appointment_time = '02:30:45';
        $order->des_appointment_time = '07:20:45';
        $order->cost = 1300;
        $order->estimated_value = 3000;
        $order->min_temperature = 28;
        $order->max_temperature = 68;
        $order->shipper_id = 1;
        $order->charge_id = 'ch_ksjduq03883';

        $order->save();

        $src_add = Shipmentaddress::find(1);
        $order->addresses()->attach($src_add, ['type'=>'src']);

        $des_add = Shipmentaddress::find(2);
        $order->addresses()->attach($des_add, ['type'=>'des']);

        $src_accessories = Accessory::where('code','bs')->orWhere('code','in')->orWhere('code','tm')->get();
        $order->accessories()->attach($src_accessories, ['type'=>'src']);

        $des_accessories = Accessory::where('code','rs')->orWhere('code','in')->orWhere('code','ap')->get();
        $order->accessories()->attach($des_accessories,['type'=>'des']);



    }
}
