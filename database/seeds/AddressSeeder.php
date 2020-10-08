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
                'name' => "101 100 Auburn Meadows MR SE Auburn Bay",
                'country_id' => 2,
                'state_id' => 1,
                'city_id' => 1,
                'zip_id' => 1,
            ],
            [
                'name' => "Cavan",
                'country_id' => 2,
                'state_id' => 1,
                'city_id' => 1,
                'zip_id' => 1,
            ],
            [
                'name' => "Bathurst Line Line",
                'country_id' => 2,
                'state_id' => 1,
                'city_id' => 1,
                'zip_id' => 1,
            ],
            [
                'name' => "Connors Cove",
                'country_id' => 2,
                'state_id' => 1,
                'city_id' => 1,
                'zip_id' => 1,
            ],
            [
                'name' => "HARBOUR",
                'country_id' => 2,
                'state_id' => 1,
                'city_id' => 1,
                'zip_id' => 1,
            ]
        ];
        Address::insert($address);
    }
}
