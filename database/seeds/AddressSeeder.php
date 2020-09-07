<?php

use App\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::truncate();
        $address =  [
            'address' => 'some test address',
            'country_id' => 1,
            'state_id' => 1,
            'city_id' => 1,
            'citycode' => 10001,
            'carrier_id' => 1,
            'shipper_id' => 1
        ];
        Address::insert($address);
    }
}
