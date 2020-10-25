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
                'address' => "Rattles Road",
                'zip' => 'A0A4G0',
                'city' => 'Victoria',
                'state' => 'BC',
                'locationtype_id' => 1,
                'country_id' => 1,
            ],
            [
                'address' => "PO BOX 1392 GREENWOOD NS",
                'zip' => 'B0P1N0',
                'city' => 'Greenwood',
                'state' => 'BC',
                'locationtype_id'=> 2,
                'country_id' => 1,
            ],
            [
                'address' => "8045300 257 Central Ave",
                'zip' => 'B0P1N0',
                'city' => 'Midway',
                'state' => 'BC',
                'locationtype_id'=> 2,
                'country_id' => 1,
            ],
            [
                'address' => "CP 119 6 ch. Bedford",
                'zip' => 'B0P1N0',
                'city' => 'Regional District of Kootenay Boundary',
                'state' => 'BC',
                'locationtype_id'=> 2,
                'country_id' => 1,
            ],
            [
                'address' => "232 STREET",
                'zip' => 'B4R2G5',
                'city' => 'Maple Ridge',
                'state' => 'BC',
                'locationtype_id'=> 2,
                'country_id' => 1,
            ],
            [
                'address' => "CLEVELAND Ave",
                'zip' => 'B8B0S8',
                'city' => 'Squamish',
                'state' => 'BC',
                'locationtype_id'=> 2,
                'country_id' => 1,
            ],
            [
                'address' => "Rte 2",
                'zip' => 'C0A2B0',
                'city' => 'SOURIS',
                'state' => 'BC',
                'locationtype_id'=> 2,
                'country_id' => 1,
            ]
        ];
        Address::insert($address);
    }
}
