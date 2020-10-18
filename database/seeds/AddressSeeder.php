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
            [
                'name' => "Rattles Road",
                'city_id' => 1,
            ],
            [
                'name' => "PO BOX 1392 GREENWOOD NS",
                'city_id' => 2,
            ]
        ];
        Address::insert($address);
    }
}
