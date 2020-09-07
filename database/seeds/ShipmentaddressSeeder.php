<?php

use App\Shipmentaddress;
use Illuminate\Database\Seeder;

class ShipmentaddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipmentaddress::truncate();
        $addresses = [
            [
                'company' => 'Company or individual name',
                'address' => 'Second streat of New york',
                'refrence' => null,
                'instructions' => null,
                'name' => 'Zia',
                'phone' => '0775050616',
                'email' => 'zia@gmail.com',
                'country_id'=> 1,
                'state_id'=> 1,
                'city_id' => 1,
                'citycode_id' => 1,
            ],
            [
                'company' => 'Company or individual name 2',
                'address' => 'Lissangelate addesre skd',
                'refrence' => null,
                'instructions' => null,
                'name' => 'Ali',
                'phone' => '0775050616',
                'email' => 'ali@gmail.com',
                'country_id'=> 1,
                'state_id'=> 1,
                'city_id' => 1,
                'citycode_id' => 2,
            ]
        ];
        Shipmentaddress::insert($addresses);
    }
}
